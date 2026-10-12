<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InstitutionController extends Controller
{
    public function index(Request $request): View
    {
        $institutions = Institution::withCount(['units', 'volunteers', 'events'])
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            })
            ->when($request->status !== null, function ($query) use ($request) {
                $query->where('is_active', $request->status === 'active');
            })
            ->latest()
            ->paginate(15);

        return view('admin.institutions.index', compact('institutions'));
    }

    public function create(): View
    {
        return view('admin.institutions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:institutions'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'pincode' => ['nullable', 'string', 'max:10'],
            'phone' => ['nullable', 'string', 'max:15'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'admin_name' => ['required', 'string', 'max:255'],
            'admin_email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'admin_password' => ['required', 'string', 'min:8'],
        ]);

        $institution = Institution::create([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'pincode' => $validated['pincode'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'website' => $validated['website'],
        ]);

        $admin = User::create([
            'name' => $validated['admin_name'],
            'email' => $validated['admin_email'],
            'password' => Hash::make($validated['admin_password']),
            'email_verified_at' => now(),
        ]);

        $admin->roles()->attach(\App\Models\Role::where('name', Role::COLLEGE_ADMIN)->first());

        return redirect()->route('admin.institutions.show', $institution)
            ->with('success', 'Institution created successfully.');
    }

    public function show(Institution $institution): View
    {
        $institution->load(['units', 'volunteers.user', 'events']);

        return view('admin.institutions.show', compact('institution'));
    }

    public function edit(Institution $institution): View
    {
        return view('admin.institutions.edit', compact('institution'));
    }

    public function update(Request $request, Institution $institution): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'pincode' => ['nullable', 'string', 'max:10'],
            'phone' => ['nullable', 'string', 'max:15'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'is_active' => ['boolean'],
        ]);

        $institution->update($validated);

        return redirect()->route('admin.institutions.show', $institution)
            ->with('success', 'Institution updated successfully.');
    }

    public function destroy(Institution $institution): RedirectResponse
    {
        if ($institution->volunteers()->count() > 0) {
            return back()->with('error', 'Cannot delete institution with volunteers. Deactivate it instead.');
        }

        $institution->delete();

        return redirect()->route('admin.institutions')
            ->with('success', 'Institution deleted successfully.');
    }
}
