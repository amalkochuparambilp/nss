<?php

namespace App\Http\Controllers\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $events = Event::where('status', 'published')
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

        return view('volunteer.events.index', compact('events', 'categories'));
    }

    public function show(Event $event): View
    {
        $user = Auth::user();
        $volunteer = $user->volunteerProfile;
        $registration = EventRegistration::where('event_id', $event->id)
            ->where('volunteer_id', $volunteer?->id)
            ->first();

        $isRegistered = !is_null($registration);
        $isDeadlinePassed = $event->registration_deadline && $event->registration_deadline->isPast();
        $isFull = $event->registrations()->whereIn('status', ['registered', 'attended'])->count() >= $event->capacity;

        return view('volunteer.events.show', compact('event', 'registration', 'isRegistered', 'isDeadlinePassed', 'isFull'));
    }

    public function myRegistrations(Request $request): View
    {
        $volunteer = $request->user()->volunteerProfile;
        $registrations = EventRegistration::with('event')
            ->where('volunteer_id', $volunteer?->id)
            ->latest()
            ->paginate(15);

        return view('volunteer.events.registrations', compact('registrations'));
    }

    public function register(Request $request, Event $event): RedirectResponse
    {
        $volunteer = $request->user()->volunteerProfile;

        if (!$volunteer || $volunteer->status !== 'approved') {
            return back()->with('error', 'You must be an approved volunteer to register.');
        }

        if ($event->status !== 'published') {
            return back()->with('error', 'This event is not open for registration.');
        }

        if ($event->registration_deadline && $event->registration_deadline->isPast()) {
            return back()->with('error', 'Registration deadline has passed.');
        }

        if ($event->start_date->isPast()) {
            return back()->with('error', 'This event has already started.');
        }

        return DB::transaction(function () use ($event, $volunteer) {
            $existingRegistration = EventRegistration::where('event_id', $event->id)
                ->where('volunteer_id', $volunteer->id)
                ->first();

            if ($existingRegistration) {
                return back()->with('error', 'You are already registered for this event.');
            }

            $currentCount = EventRegistration::where('event_id', $event->id)
                ->whereIn('status', ['registered', 'attended'])
                ->lockForUpdate()
                ->count();

            $status = 'registered';
            $waitlistPosition = null;

            if ($event->capacity > 0 && $currentCount >= $event->capacity) {
                $status = 'waitlisted';
                $maxWaitlist = EventRegistration::where('event_id', $event->id)
                    ->where('status', 'waitlisted')
                    ->max('waitlist_position');
                $waitlistPosition = $maxWaitlist ? $maxWaitlist + 1 : 1;
            }

            EventRegistration::create([
                'event_id' => $event->id,
                'volunteer_id' => $volunteer->id,
                'status' => $status,
                'registered_at' => now(),
                'waitlist_position' => $waitlistPosition,
            ]);

            $message = $status === 'waitlisted'
                ? 'You have been added to the waitlist.'
                : 'Registration successful.';

            return redirect()->route('volunteer.events.show', $event)->with('success', $message);
        });
    }

    public function cancelRegistration(Request $request, Event $event): RedirectResponse
    {
        $volunteer = $request->user()->volunteerProfile;

        $registration = EventRegistration::where('event_id', $event->id)
            ->where('volunteer_id', $volunteer?->id)
            ->firstOrFail();

        if ($registration->status === 'cancelled') {
            return back()->with('error', 'Registration is already cancelled.');
        }

        return DB::transaction(function () use ($event, $registration) {
            $wasRegistered = $registration->status === 'registered';
            $registration->update(['status' => 'cancelled']);

            if ($wasRegistered) {
                $nextWaitlisted = EventRegistration::where('event_id', $event->id)
                    ->where('status', 'waitlisted')
                    ->orderBy('waitlist_position')
                    ->first();

                if ($nextWaitlisted) {
                    $nextWaitlisted->update([
                        'status' => 'registered',
                        'waitlist_position' => null,
                    ]);
                }
            }

            return back()->with('success', 'Registration cancelled successfully.');
        });
    }
}
