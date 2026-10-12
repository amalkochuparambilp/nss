<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - NSS Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#173B70',
                        accent: '#E53935',
                        surface: '#F7F9FC',
                        card: '#FFFFFF',
                        maintext: '#172033',
                        secondarytext: '#667085',
                        success: '#16803C',
                        warning: '#B54708',
                        error: '#B42318',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-maintext font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <aside class="hidden lg:flex lg:flex-col w-64 bg-primary text-white">
            <div class="p-6">
                <a href="{{ route('volunteer.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="font-bold text-lg">N</span>
                    </div>
                    <span class="font-bold text-lg">NSS Connect</span>
                </a>
            </div>
            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ route('volunteer.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg bg-white/10 text-white">
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
                <a href="{{ route('volunteer.attendance') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
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
            </nav>
            <div class="p-4 border-t border-white/20">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-white/60 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm text-white/70 hover:text-white transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm lg:hidden">
                <div class="flex items-center justify-between px-4 py-3">
                    <a href="{{ route('volunteer.dashboard') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">N</span>
                        </div>
                        <span class="font-bold text-primary">NSS Connect</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-secondarytext text-sm">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 lg:p-8">
                @if(session('success'))
                    <div class="bg-success/10 border border-success/30 text-success px-4 py-3 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-error/10 border border-error/30 text-error px-4 py-3 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-primary">Welcome back, {{ auth()->user()->name }}</h1>
                    <p class="text-secondarytext">Here's what's happening with your NSS activities.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-card rounded-xl p-6 shadow-sm">
                        <div class="text-sm text-secondarytext mb-1">Total Service Hours</div>
                        <div class="text-3xl font-bold text-primary">{{ $totalHours }}</div>
                    </div>
                    <div class="bg-card rounded-xl p-6 shadow-sm">
                        <div class="text-sm text-secondarytext mb-1">Events Attended</div>
                        <div class="text-3xl font-bold text-success">{{ $attendanceCount }}</div>
                    </div>
                    <div class="bg-card rounded-xl p-6 shadow-sm">
                        <div class="text-sm text-secondarytext mb-1">Upcoming Events</div>
                        <div class="text-3xl font-bold text-accent">{{ $upcomingEvents->count() }}</div>
                    </div>
                    <div class="bg-card rounded-xl p-6 shadow-sm">
                        <div class="text-sm text-secondarytext mb-1">Unread Notifications</div>
                        <div class="text-3xl font-bold text-warning">{{ $notifications->count() }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-lg font-semibold text-primary mb-4">Upcoming Events</h2>
                        @if($upcomingEvents->count() > 0)
                            <div class="space-y-3">
                                @foreach($upcomingEvents as $event)
                                    <a href="{{ route('volunteer.events.show', $event) }}" class="block bg-card rounded-lg p-4 shadow-sm hover:shadow-md transition">
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
                        @if($myRegistrations->count() > 0)
                            <div class="space-y-3">
                                @foreach($myRegistrations as $registration)
                                    <div class="bg-card rounded-lg p-4 shadow-sm">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <div class="font-medium">{{ $registration->event->title }}</div>
                                                <div class="text-sm text-secondarytext">{{ $registration->registered_at?->format('M d, Y') }}</div>
                                            </div>
                                            <span class="text-xs px-2 py-1 rounded
                                                {{ $registration->status === 'registered' ? 'bg-success/10 text-success' : '' }}
                                                {{ $registration->status === 'waitlisted' ? 'bg-warning/10 text-warning' : '' }}
                                                {{ $registration->status === 'cancelled' ? 'bg-error/10 text-error' : '' }}">
                                                {{ ucfirst($registration->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-secondarytext">No registrations yet.</p>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
