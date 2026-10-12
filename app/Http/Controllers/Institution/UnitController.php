<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Models\NSSUnit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnitController extends Controller
{
    public function index(Request $request): View
    {
        $institution = $request->user()->adminProfile?->institution;

        $units = NSSUnit::withCount(['volunteers', 'events'])
            ->where('institution_id', $institution?->id)
            ->paginate(15);

        return view('institution.units.index', compact('units'));
    }

    public function create(): View
    {
        return view('institution.units.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $institution = $request->user()->adminProfile?->institution;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:nss_units,code,NULL,id,institution_id,' . $institution?->id],
            'description' => ['nullable', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
        ]);

        NSSUnit::create([
            'institution_id' => $institution->id,
            'name' => $validated['name'],
            'code' => $validated['code'],
            'description' => $validated['description'],
            'capacity' => $validated['capacity'],
        ]);

        return redirect()->route('institution.units')->with('success', 'NSS Unit created successfully.');
    }

    public function edit(NSSUnit $unit): View
    {
        return view('institution.units.edit', compact('unit'));
    }

    public function update(Request $request, NSSUnit $unit): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
            'is_active' => ['boolean'],
        ]);

        $unit->update($validated);

        return redirect()->route('institution.units')->with('success', 'NSS Unit updated successfully.');
    }
}
