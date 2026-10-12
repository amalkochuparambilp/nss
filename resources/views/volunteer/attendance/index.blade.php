@extends('layouts.app')

@section('title', 'Attendance')

@section('sidebar')
    <a href="{{ route('volunteer.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('volunteer.events') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        Events
    </a>
    <a href="{{ route('volunteer.my-registrations') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        My Registrations
    </a>
    <a href="{{ route('volunteer.service-hours') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Service Hours
    </a>
    <a href="{{ route('volunteer.attendance') }}" class="flex items-center px-3 py-2 rounded-lg bg-white/10 text-white">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Attendance
    </a>
    <a href="{{ route('volunteer.certificates') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
        Certificates
    </a>
    <a href="{{ route('volunteer.notifications') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        Notifications
    </a>
    <a href="{{ route('volunteer.profile') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        Profile
    </a>
@endsection

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary">Attendance</h1>
        <p class="text-secondarytext">View your attendance records.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Present</div>
            <div class="text-3xl font-bold text-success">{{ $stats['present'] }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Absent</div>
            <div class="text-3xl font-bold text-error">{{ $stats['absent'] }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Excused</div>
            <div class="text-3xl font-bold text-warning">{{ $stats['excused'] }}</div>
        </div>
    </div>

    @if($attendance->count() > 0)
        <div class="space-y-4">
            @foreach($attendance as $record)
                <div class="bg-card rounded-xl p-6 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div>
                            <h3 class="font-semibold">{{ $record->event->title }}</h3>
                            <p class="text-secondarytext text-sm">{{ $record->event->start_date->format('M d, Y') }}</p>
                        </div>
                        <div class="mt-2 md:mt-0">
                            <span class="text-xs px-3 py-1 rounded-full font-medium
                                {{ $record->status === 'present' ? 'bg-success/10 text-success' : '' }}
                                {{ $record->status === 'absent' ? 'bg-error/10 text-error' : '' }}
                                {{ $record->status === 'excused' ? 'bg-warning/10 text-warning' : '' }}
                                {{ $record->status === 'finalized' ? 'bg-primary/10 text-primary' : '' }}">
                                {{ ucfirst($record->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $attendance->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-secondarytext">No attendance records yet.</p>
        </div>
    @endif
@endsection
