<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\ServiceHourRecord;
use App\Models\VolunteerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceHourController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $units = $user->officerAssignments()->where('is_active', true)->pluck('unit_id');

        $records = ServiceHourRecord::with(['volunteer', 'event', 'reviewer'])
            ->whereHas('volunteer', function ($query) use ($units) {
                $query->whereIn('unit_id', $units);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('approval_status', $status);
            })
            ->latest()
            ->paginate(20);

        $pendingCount = ServiceHourRecord::whereHas('volunteer', function ($query) use ($units) {
            $query->whereIn('unit_id', $units);
        })->where('approval_status', 'pending')->count();

        return view('officer.service-hours.index', compact('records', 'pendingCount'));
    }

    public function show(ServiceHourRecord $record): View
    {
        $record->load(['volunteer', 'event', 'reviewer']);

        return view('officer.service-hours.show', compact('record'));
    }

    public function approve(Request $request, ServiceHourRecord $record): RedirectResponse
    {
        if ($record->approval_status !== ServiceHourRecord::STATUS_PENDING) {
            return back()->with('error', 'This record is not pending approval.');
        }

        $validated = $request->validate([
            'approved_hours' => ['required', 'numeric', 'min:0', 'max:' . $record->submitted_hours],
        ]);

        $record->update([
            'approval_status' => ServiceHourRecord::STATUS_APPROVED,
            'approved_hours' => $validated['approved_hours'],
            'reviewer_id' => Auth::id(),
            'review_timestamp' => now(),
            'rejection_reason' => null,
        ]);

        $record->volunteer->user->notify(new \App\Notifications\ServiceHourApproved($record));

        return back()->with('success', 'Service hours approved.');
    }

    public function reject(Request $request, ServiceHourRecord $record): RedirectResponse
    {
        if ($record->approval_status !== ServiceHourRecord::STATUS_PENDING) {
            return back()->with('error', 'This record is not pending approval.');
        }

        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        $record->update([
            'approval_status' => ServiceHourRecord::STATUS_REJECTED,
            'reviewer_id' => Auth::id(),
            'review_timestamp' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        $record->volunteer->user->notify(new \App\Notifications\ServiceHourRejected($record, $validated['rejection_reason']));

        return back()->with('success', 'Service hours rejected.');
    }
}
