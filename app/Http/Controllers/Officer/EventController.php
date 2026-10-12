<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\NSSUnit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $units = $user->officerAssignments()->where('is_active', true)->pluck('unit_id');

        $events = Event::with(['unit', 'registrations'])
            ->whereIn('unit_id', $units)
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->latest()
            ->paginate(15);

        $categories = Event::whereIn('unit_id', $units)->distinct()->pluck('category');

        return view('officer.events.index', compact('events', 'categories'));
    }

    public function create(): View
    {
        $user = Auth::user();
        $units = NSSUnit::whereIn('id', $user->officerAssignments()->where('is_active', true)->pluck('unit_id'))->get();

        return view('officer.events.create', compact('units'));
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $units = $user->officerAssignments()->where('is_active', true)->pluck('unit_id');

        $validated = $request->validate([
            'unit_id' => ['required', 'exists:nss_units,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'venue' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'registration_deadline' => ['nullable', 'date', 'before:start_date'],
            'capacity' => ['required', 'integer', 'min:1'],
            'eligibility_conditions' => ['nullable', 'string'],
            'visibility' => ['required', 'in:public,internal'],
            'status' => ['required', 'in:draft,published'],
        ]);

        if (!$units->contains($validated['unit_id'])) {
            return back()->with('error', 'You are not authorized to create events for this unit.');
        }

        $event = Event::create([
            'institution_id' => $request->user()->volunteerProfile?->institution_id ?? NSSUnit::find($validated['unit_id'])->institution_id,
            'unit_id' => $validated['unit_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'venue' => $validated['venue'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'registration_deadline' => $validated['registration_deadline'],
            'capacity' => $validated['capacity'],
            'eligibility_conditions' => $validated['eligibility_conditions'],
            'visibility' => $validated['visibility'],
            'status' => $validated['status'],
            'registration_status' => 'open',
        ]);

        return redirect()->route('officer.events.show', $event)->with('success', 'Event created successfully.');
    }

    public function show(Event $event): View
    {
        $event->load(['unit', 'registrations.volunteer', 'attendanceRecords.volunteer']);

        return view('officer.events.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        $user = Auth::user();
        $units = NSSUnit::whereIn('id', $user->officerAssignments()->where('is_active', true)->pluck('unit_id'))->get();

        return view('officer.events.edit', compact('event', 'units'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'venue' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'registration_deadline' => ['nullable', 'date', 'before:start_date'],
            'capacity' => ['required', 'integer', 'min:1'],
            'eligibility_conditions' => ['nullable', 'string'],
            'visibility' => ['required', 'in:public,internal'],
            'status' => ['required', 'in:draft,published,ongoing,completed,cancelled'],
        ]);

        $event->update($validated);

        return redirect()->route('officer.events.show', $event)->with('success', 'Event updated successfully.');
    }

    public function cancel(Event $event): RedirectResponse
    {
        if ($event->status === Event::STATUS_CANCELLED) {
            return back()->with('error', 'Event is already cancelled.');
        }

        if ($event->status === Event::STATUS_COMPLETED) {
            return back()->with('error', 'Cannot cancel a completed event.');
        }

        $event->update(['status' => Event::STATUS_CANCELLED]);

        return back()->with('success', 'Event cancelled successfully.');
    }
}
