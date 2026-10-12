<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\NSSUnit;
use App\Models\VolunteerProfile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $institution = $request->user()->adminProfile?->institution;

        $totalUnits = NSSUnit::where('institution_id', $institution?->id)->count();
        $totalVolunteers = VolunteerProfile::where('institution_id', $institution?->id)
            ->where('status', 'approved')
            ->count();
        $pendingVolunteers = VolunteerProfile::where('institution_id', $institution?->id)
            ->where('status', 'pending')
            ->count();
        $totalEvents = Event::where('institution_id', $institution?->id)->count();
        $upcomingEvents = Event::where('institution_id', $institution?->id)
            ->where('status', 'published')
            ->where('start_date', '>', now())
            ->count();

        return view('institution.dashboard', compact(
            'institution',
            'totalUnits',
            'totalVolunteers',
            'pendingVolunteers',
            'totalEvents',
            'upcomingEvents'
        ));
    }
}
