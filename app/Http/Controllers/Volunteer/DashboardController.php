<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Notification;
use App\Models\ServiceHourRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $volunteer = $user->volunteerProfile;

        $upcomingEvents = Event::where('status', 'published')
            ->where('start_date', '>', now())
            ->orderBy('start_date')
            ->take(5)
            ->get();

        $myRegistrations = EventRegistration::with('event')
            ->where('volunteer_id', $volunteer?->id)
            ->latest()
            ->take(5)
            ->get();

        $totalHours = ServiceHourRecord::where('volunteer_id', $volunteer?->id)
            ->where('approval_status', 'approved')
            ->sum('approved_hours');

        $attendanceCount = Attendance::where('volunteer_id', $volunteer?->id)
            ->where('status', 'present')
            ->count();

        $notifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->latest()
            ->take(5)
            ->get();

        return view('volunteer.dashboard', compact(
            'upcomingEvents',
            'myRegistrations',
            'totalHours',
            'attendanceCount',
            'notifications',
            'volunteer'
        ));
    }
}
