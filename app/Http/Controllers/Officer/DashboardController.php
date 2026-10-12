<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\ServiceHourRecord;
use App\Models\VolunteerProfile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $units = $user->officerAssignments()->where('is_active', true)->pluck('unit_id');

        $totalVolunteers = VolunteerProfile::whereIn('unit_id', $units)
            ->where('status', 'approved')
            ->count();

        $pendingVolunteers = VolunteerProfile::whereIn('unit_id', $units)
            ->where('status', 'pending')
            ->count();

        $upcomingEvents = Event::whereIn('unit_id', $units)
            ->where('status', 'published')
            ->where('start_date', '>', now())
            ->orderBy('start_date')
            ->take(5)
            ->get();

        $recentRegistrations = EventRegistration::with(['event', 'volunteer'])
            ->whereHas('event', function ($query) use ($units) {
                $query->whereIn('unit_id', $units);
            })
            ->latest()
            ->take(10)
            ->get();

        $pendingServiceHours = ServiceHourRecord::with(['volunteer', 'event'])
            ->whereHas('volunteer', function ($query) use ($units) {
                $query->whereIn('unit_id', $units);
            })
            ->where('approval_status', 'pending')
            ->count();

        $recentAttendance = Attendance::with(['event', 'volunteer'])
            ->whereHas('event', function ($query) use ($units) {
                $query->whereIn('unit_id', $units);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('officer.dashboard', compact(
            'totalVolunteers',
            'pendingVolunteers',
            'upcomingEvents',
            'recentRegistrations',
            'pendingServiceHours',
            'recentAttendance'
        ));
    }
}
