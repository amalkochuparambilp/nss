<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\ServiceHourRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ServiceHourController extends Controller
{
    public function index(Request $request): View
    {
        $volunteer = $request->user()->volunteerProfile;

        $records = ServiceHourRecord::with('event')
            ->where('volunteer_id', $volunteer?->id)
            ->latest()
            ->paginate(15);

        $totalApproved = ServiceHourRecord::where('volunteer_id', $volunteer?->id)
            ->where('approval_status', 'approved')
            ->sum('approved_hours');

        $totalPending = ServiceHourRecord::where('volunteer_id', $volunteer?->id)
            ->where('approval_status', 'pending')
            ->sum('submitted_hours');

        $totalRejected = ServiceHourRecord::where('volunteer_id', $volunteer?->id)
            ->where('approval_status', 'rejected')
            ->count();

        $events = Event::where('status', 'completed')
            ->orderBy('end_date', 'desc')
            ->get();

        return view('volunteer.service-hours.index', compact(
            'records',
            'totalApproved',
            'totalPending',
            'totalRejected',
            'events'
        ));
    }

    public function create(Request $request): View
    {
        $events = Event::where('status', 'completed')
            ->orderBy('end_date', 'desc')
            ->get();

        return view('volunteer.service-hours.create', compact('events'));
    }

    public function store(Request $request): RedirectResponse
    {
        $volunteer = $request->user()->volunteerProfile;

        $validated = $request->validate([
            'event_id' => ['required', 'exists:events,id'],
            'service_activity' => ['required', 'string', 'max:255'],
            'submitted_hours' => ['required', 'numeric', 'min:0.5', 'max:24'],
        ]);

        $duplicate = ServiceHourRecord::where('volunteer_id', $volunteer->id)
            ->where('event_id', $validated['event_id'])
            ->where('service_activity', $validated['service_activity'])
            ->whereIn('approval_status', ['pending', 'approved'])
            ->first();

        if ($duplicate) {
            return back()->with('error', 'A similar service hour record already exists.');
        }

        ServiceHourRecord::create([
            'volunteer_id' => $volunteer->id,
            'event_id' => $validated['event_id'],
            'service_activity' => $validated['service_activity'],
            'submitted_hours' => $validated['submitted_hours'],
            'approval_status' => 'pending',
            'submission_date' => now(),
        ]);

        return redirect()->route('volunteer.service-hours')->with('success', 'Service hours submitted successfully.');
    }

    public function show(ServiceHourRecord $record): View
    {
        $this->authorize('view', $record);

        return view('volunteer.service-hours.show', compact('record'));
    }
}
