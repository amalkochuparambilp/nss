<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - NSS Connect</title>
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
                <a href="{{ route('officer.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="font-bold text-lg">N</span>
                    </div>
                    <span class="font-bold text-lg">NSS Connect</span>
                </a>
            </div>
            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ route('officer.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('officer.volunteers') }}" class="flex items-center px-3 py-2 rounded-lg text-white/70 hover:bg-white/10 hover:text-white transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Volunteers
                </a>
                <a href="{{ route('officer.events') }}" class="flex items-center px-3 py-2 rounded-lg bg-white/10 text-white">
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
            <main class="flex-1 overflow-y-auto p-4 lg:p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-primary">Event Management</h1>
                        <p class="text-secondarytext">Create and manage NSS events.</p>
                    </div>
                    <a href="{{ route('officer.events.create') }}" class="mt-4 md:mt-0 bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition">
                        Create Event
                    </a>
                </div>

                @if($events->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($events as $event)
                            <div class="bg-card rounded-xl p-6 shadow-sm hover:shadow-md transition">
                                <div class="text-xs font-semibold text-accent uppercase mb-2">{{ $event->category }}</div>
                                <h3 class="font-semibold text-lg mb-2">{{ $event->title }}</h3>
                                <p class="text-secondarytext text-sm mb-4">{{ Str::limit($event->description, 100) }}</p>
                                <div class="space-y-2 text-sm text-secondarytext mb-4">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $event->start_date->format('M d, Y') }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $event->registrations->count() }} / {{ $event->capacity }} registered
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs px-3 py-1 rounded-full font-medium
                                        {{ $event->status === 'published' ? 'bg-success/10 text-success' : '' }}
                                        {{ $event->status === 'draft' ? 'bg-secondarytext/10 text-secondarytext' : '' }}
                                        {{ $event->status === 'completed' ? 'bg-primary/10 text-primary' : '' }}
                                        {{ $event->status === 'cancelled' ? 'bg-error/10 text-error' : '' }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                    <a href="{{ route('officer.events.show', $event) }}" class="text-primary font-medium text-sm hover:underline">Manage</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        {{ $events->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-secondarytext">No events yet.</p>
                    </div>
                @endif
            </main>
        </div>
    </div>
</body>
</html>
