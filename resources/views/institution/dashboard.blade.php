@import('layouts.app')

@section('title', 'Institution Dashboard')

@section('sidebar')
    <a href="{{ route('institution.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg bg-white/10 text-white">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('institution.units') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        NSS Units
    </a>
    <a href="{{ route('institution.reports') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Reports
    </a>
    <a href="{{ route('institution.audit-logs') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Audit Logs
    </a>
@endsection

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary">{{ $institution?->name ?? 'Institution' }} Dashboard</h1>
        <p class="text-secondarytext">Institution management overview.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">NSS Units</div>
            <div class="text-3xl font-bold text-primary">{{ $totalUnits }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Active Volunteers</div>
            <div class="text-3xl font-bold text-success">{{ $totalVolunteers }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Pending Approvals</div>
            <div class="text-3xl font-bold text-warning">{{ $pendingVolunteers }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Upcoming Events</div>
            <div class="text-3xl font-bold text-accent">{{ $upcomingEvents }}</div>
        </div>
    </div>
@endsection
