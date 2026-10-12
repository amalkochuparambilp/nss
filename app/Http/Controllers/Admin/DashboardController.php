<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\VolunteerProfile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalInstitutions = Institution::count();
        $activeInstitutions = Institution::where('is_active', true)->count();
        $totalUsers = User::count();
        $totalVolunteers = VolunteerProfile::where('status', 'approved')->count();
        $pendingVolunteers = VolunteerProfile::where('status', 'pending')->count();

        $recentInstitutions = Institution::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalInstitutions',
            'activeInstitutions',
            'totalUsers',
            'totalVolunteers',
            'pendingVolunteers',
            'recentInstitutions',
            'recentUsers'
        ));
    }
}
