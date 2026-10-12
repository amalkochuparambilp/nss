<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $volunteer = $request->user()->volunteerProfile;

        $attendance = Attendance::with('event')
            ->where('volunteer_id', $volunteer?->id)
            ->latest()
            ->paginate(20);

        $stats = [
            'present' => Attendance::where('volunteer_id', $volunteer?->id)->where('status', 'present')->count(),
            'absent' => Attendance::where('volunteer_id', $volunteer?->id)->where('status', 'absent')->count(),
            'excused' => Attendance::where('volunteer_id', $volunteer?->id)->where('status', 'excused')->count(),
        ];

        return view('volunteer.attendance.index', compact('attendance', 'stats'));
    }
}
