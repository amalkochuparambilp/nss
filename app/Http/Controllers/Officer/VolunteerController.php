<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\NSSUnit;
use App\Models\VolunteerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VolunteerController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $units = $user->officerAssignments()->where('is_active', true)->pluck('unit_id');

        $volunteers = VolunteerProfile::with(['user', 'institution', 'unit'])
            ->whereIn('unit_id', $units)
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->search, function ($query, $search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('enrollment_number', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(20);

        return view('officer.volunteers.index', compact('volunteers'));
    }

    public function show(VolunteerProfile $volunteer): View
    {
        $volunteer->load(['user', 'institution', 'unit', 'eventRegistrations.event', 'attendanceRecords.event', 'serviceHourRecords.event']);

        return view('officer.volunteers.show', compact('volunteer'));
    }

    public function approve(Request $request, VolunteerProfile $volunteer): RedirectResponse
    {
        if ($volunteer->status !== 'pending') {
            return back()->with('error', 'This volunteer is not pending approval.');
        }

        $volunteer->update([
            'status' => VolunteerProfile::STATUS_APPROVED,
            'rejection_reason' => null,
        ]);

        $volunteer->user->notify(new \App\Notifications\VolunteerApproved($volunteer));

        return back()->with('success', 'Volunteer approved successfully.');
    }

    public function reject(Request $request, VolunteerProfile $volunteer): RedirectResponse
    {
        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:500'],
        ]);

        if ($volunteer->status !== 'pending') {
            return back()->with('error', 'This volunteer is not pending approval.');
        }

        $volunteer->update([
            'status' => VolunteerProfile::STATUS_REJECTED,
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        $volunteer->user->notify(new \App\Notifications\VolunteerRejected($volunteer, $validated['rejection_reason']));

        return back()->with('success', 'Volunteer rejected.');
    }
}
