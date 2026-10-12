@import('layouts.app')

@section('title', 'Admin Dashboard')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg bg-white/10 text-white">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Dashboard
    </a>
    <a href="{{ route('admin.institutions') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        Institutions
    </a>
    <a href="{{ route('admin.users') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        Users
    </a>
    <a href="{{ route('admin.audit-logs') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Audit Logs
    </a>
@endsection

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-primary">Super Admin Dashboard</h1>
        <p class="text-secondarytext">Platform administration overview.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Total Institutions</div>
            <div class="text-3xl font-bold text-primary">{{ $totalInstitutions }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Active Institutions</div>
            <div class="text-3xl font-bold text-success">{{ $activeInstitutions }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Total Users</div>
            <div class="text-3xl font-bold text-accent">{{ $totalUsers }}</div>
        </div>
        <div class="bg-card rounded-xl p-6 shadow-sm">
            <div class="text-sm text-secondarytext mb-1">Pending Volunteers</div>
            <div class="text-3xl font-bold text-warning">{{ $pendingVolunteers }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <h2 class="text-lg font-semibold text-primary mb-4">Recent Institutions</h2>
            @if($recentInstitutions->count() > 0)
                <div class="space-y-3">
                    @foreach($recentInstitutions as $inst)
                        <a href="{{ route('admin.institutions.show', $inst) }}" class="block bg-card rounded-lg p-4 shadow-sm hover:shadow-md transition">
                            <div class="font-medium">{{ $inst->name }}</div>
                            <div class="text-sm text-secondarytext">{{ $inst->city }}, {{ $inst->state }}</div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-secondarytext">No institutions yet.</p>
            @endif
        </div>

        <div>
            <h2 class="text-lg font-semibold text-primary mb-4">Recent Users</h2>
            @if($recentUsers->count() > 0)
                <div class="space-y-3">
                    @foreach($recentUsers as $user)
                        <div class="bg-card rounded-lg p-4 shadow-sm">
                            <div class="font-medium">{{ $user->name }}</div>
                            <div class="text-sm text-secondarytext">{{ $user->email }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-secondarytext">No users yet.</p>
            @endif
        </div>
    </div>
@endsection
