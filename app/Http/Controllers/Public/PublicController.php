<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        $upcomingEvents = Event::where('status', 'published')
            ->where('visibility', 'public')
            ->where('start_date', '>', now())
            ->orderBy('start_date')
            ->take(6)
            ->get();

        $announcements = Announcement::whereNotNull('published_at')
            ->where('is_pinned', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return view('public.home', compact('upcomingEvents', 'announcements'));
    }

    public function about(): View
    {
        return view('public.about');
    }

    public function events(Request $request): View
    {
        $events = Event::where('status', 'published')
            ->where('visibility', 'public')
            ->when($request->category, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('start_date', 'desc')
            ->paginate(12);

        $categories = Event::where('status', 'published')
            ->distinct()
            ->pluck('category');

        return view('public.events', compact('events', 'categories'));
    }

    public function eventDetails(Event $event): View
    {
        abort_if($event->status !== 'published' || $event->visibility !== 'public', 404);

        return view('public.event-details', compact('event'));
    }

    public function impact(): View
    {
        $approvedReports = \App\Models\ActivityReport::where('review_status', 'approved')
            ->with('event')
            ->orderBy('activity_date', 'desc')
            ->paginate(9);

        return view('public.impact', compact('approvedReports'));
    }

    public function privacy(): View
    {
        return view('public.privacy');
    }

    public function terms(): View
    {
        return view('public.terms');
    }

    public function contact(): View
    {
        return view('public.contact');
    }
}
