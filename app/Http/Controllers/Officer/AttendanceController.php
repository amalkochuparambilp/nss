<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\VolunteerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $units = $user->officerAssignments()->where('is_active', true)->pluck('unit_id');

        $events = Event::with(['attendanceRecords.volunteer', 'registrations'])
            ->whereIn('unit_id', $units)
            ->whereIn('status', ['ongoing', 'completed'])
            ->latest()
            ->paginate(10);

        return view('officer.attendance.index', compact('events'));
    }

    public function show(Event $event): View
    {
        $registrations = EventRegistration::with('volunteer')
            ->where('event_id', $event->id)
            ->whereIn('status', ['registered', 'attended'])
            ->get();

        $attendanceRecords = Attendance::with('volunteer')
            ->where('event_id', $event->id)
            ->get();

        $attendanceByVolunteer = $attendanceRecords->keyBy('volunteer_id');

        return view('officer.attendance.show', compact('event', 'registrations', 'attendanceByVolunteer'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        if ($event->status !== Event::STATUS_ONGOING) {
            return back()->with('error', 'Attendance can only be recorded for ongoing events.');
        }

        $validated = $request->validate([
            'attendance.*.volunteer_id' => ['required', 'exists:volunteer_profiles,id'],
            'attendance.*.status' => ['required', 'in:present,absent,excused'],
            'attendance.*.remarks' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($validated['attendance'] as $record) {
            $existing = Attendance::where('event_id', $event->id)
                ->where('volunteer_id', $record['volunteer_id'])
                ->first();

            if ($existing && $existing->status === Attendance::STATUS_FINALIZED) {
                continue;
            }

            Attendance::updateOrCreate(
                [
                    'event_id' => $event->id,
                    'volunteer_id' => $record['volunteer_id'],
                ],
                [
                    'status' => $record['status'],
                    'remarks' => $record['remarks'] ?? null,
                    'recorded_by' => Auth::id(),
                    'finalized_by' => null,
                    'finalized_at' => null,
                ]
            );
        }

        return back()->with('success', 'Attendance recorded successfully.');
    }

    public function finalize(Request $request, Event $event): RedirectResponse
    {
        if ($event->status !== Event::STATUS_ONGOING) {
            return back()->with('error', 'Only ongoing events can be finalized.');
        }

        $attendanceRecords = Attendance::where('event_id', $event->id)->get();

        foreach ($attendanceRecords as $record) {
            $record->update([
                'status' => Attendance::STATUS_FINALIZED,
                'finalized_by' => Auth::id(),
                'finalized_at' => now(),
            ]);
        }

        $registrations = EventRegistration::where('event_id', $event->id)
            ->where('status', EventRegistration::STATUS_REGISTERED)
            ->get();

        foreach ($registrations as $registration) {
            $hasAttendance = $attendanceRecords->contains(function ($record) use ($registration) {
                return $record->volunteer_id === $registration->volunteer_id &&
                    in_array($record->status, [Attendance::STATUS_PRESENT, Attendance::STATUS_FINALIZED]);
            });

            $registration->update([
                'status' => $hasAttendance ? EventRegistration::STATUS_ATTENDED : EventRegistration::STATUS_CANCELLED,
            ]);
        }

        $event->update(['status' => Event::STATUS_COMPLETED]);

        return back()->with('success', 'Attendance finalized and event marked as completed.');
    }
}
