<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        $volunteer = $user->volunteerProfile()->with(['institution', 'unit'])->first();

        return view('volunteer.profile.show', compact('volunteer', 'user'));
    }

    public function edit(Request $request): View
    {
        $user = $request->user();
        $volunteer = $user->volunteerProfile;

        return view('volunteer.profile.edit', compact('volunteer', 'user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $volunteer = $request->user()->volunteerProfile;

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:15'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'pincode' => ['nullable', 'string', 'max:10'],
            'course' => ['nullable', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:100'],
            'year_of_study' => ['nullable', 'string', 'max:20'],
            'blood_group' => ['nullable', 'string', 'max:5'],
            'emergency_contact_name' => ['nullable', 'string', 'max:100'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:15'],
        ]);

        $volunteer->update($validated);

        return redirect()->route('volunteer.profile')->with('success', 'Profile updated successfully.');
    }
}
