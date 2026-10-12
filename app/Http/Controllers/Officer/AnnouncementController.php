<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $units = $user->officerAssignments()->where('is_active', true)->pluck('unit_id');

        $announcements = Announcement::with('publisher')
            ->whereIn('unit_id', $units)
            ->latest()
            ->paginate(15);

        return view('officer.announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        $user = Auth::user();
        $units = $user->officerAssignments()->where('is_active', true)->get();
        $events = Event::whereIn('unit_id', $units->pluck('id'))->get();

        return view('officer.announcements.create', compact('units', 'events'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'event_id' => ['nullable', 'exists:events,id'],
            'is_pinned' => ['boolean'],
        ]);

        Announcement::create([
            'unit_id' => Auth::user()->officerAssignments()->where('is_active', true)->first()?->unit_id,
            'event_id' => $validated['event_id'] ?? null,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_by' => Auth::id(),
            'published_at' => now(),
            'is_pinned' => $request->boolean('is_pinned', false),
        ]);

        return redirect()->route('officer.announcements')->with('success', 'Announcement published successfully.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();

        return back()->with('success', 'Announcement deleted successfully.');
    }
}
