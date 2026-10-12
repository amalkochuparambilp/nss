@extends('layouts.app')

@section('title', 'Officer Dashboard')

@section('sidebar')
    <a href="{{ route('officer.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg bg-white/10 text-white">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('officer.volunteers') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        Volunteers
    </a>
    <a href="{{ route('officer.events') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        Events
    </a>
    <a href="{{ route('officer.attendance') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Attendance
    </a>
    <a href="{{ route('officer.service-hours') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Service Hours
    </a>
    <a href="{{ route('officer.announcements') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
        Announcements
    </a>
    <a href="{{ route('officer.certificates') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
        Certificates
    </a>
@endsection

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary">Programme Officer Dashboard</h1>
        <p class="text-secondarytext">Manage your NSS unit activities.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Total Volunteers</div>
            <div class="text-3xl font-bold text-primary">{{ $totalVolunteers }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Pending Approvals</div>
            <div class="text-3xl font-bold text-warning">{{ $pendingVolunteers }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Upcoming Events</div>
            <div class="text-3xl font-bold text-accent">{{ $upcomingEvents->count() }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Pending Service Hours</div>
            <div class="text-3xl font-bold text-success">{{ $pendingServiceHours }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <h2 class="text-lg font-semibold text-primary mb-4">Upcoming Events</h2>
            @if($upcomingEvents->count() > 0)
                <div class="space-y-3">
                    @foreach($upcomingEvents as $event)
                        <a href="{{ route('officer.events.show', $event) }}" class="block bg-card rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="font-medium">{{ $event->title }}</div>
                                    <div class="text-sm text-secondarytext">{{ $event->start_date->format('M d, Y') }}</div>
                                </div>
                                <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded">{{ $event->category }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-secondarytext">No upcoming events.</p>
            @endif
        </div>

        <div>
            <h2 class="text-lg font-semibold text-primary mb-4">Recent Registrations</h2>
            @if($recentRegistrations->count() > 0)
                <div class="space-y-3">
                    @foreach($recentRegistrations as $registration)
                        <div class="bg-card rounded-lg p-4 shadow-sm">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="font-medium">{{ $registration->volunteer->full_name }}</div>
                                    <div class="text-sm text-secondarytext">{{ $registration->event->title }}</div>
                                </div>
                                <span class="text-xs px-2 py-1 rounded
                                    {{ $registration->status === 'registered' ? 'bg-success/10 text-success' : '' }}
                                    {{ $registration->status === 'waitlisted' ? 'bg-warning/10 text-warning' : '' }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-secondarytext">No recent registrations.</p>
            @endif
        </div>
    </div>
@endsection
