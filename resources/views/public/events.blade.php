@extends('layouts.public')

@section('title', 'Events')

@section('content')
<section class="bg-primary text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-4">Events</h1>
        <p class="text-white/80 text-lg max-w-2xl">
            Discover upcoming NSS events and community service activities.
        </p>
    </div>
</section>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <form method="GET" action="{{ route('events') }}" class="flex flex-col md:flex-row gap-4 flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search events..."
                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/90 transition">
                    Search
                </button>
            </form>
        </div>

        @if($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-card rounded-xl p-6 shadow-sm hover:shadow-md transition">
                        <div class="text-xs font-semibold text-accent uppercase mb-2">{{ $event->category }}</div>
                        <h3 class="font-semibold text-lg mb-2">{{ $event->title }}</h3>
                        <p class="text-secondarytext text-sm mb-4">{{ Str::limit($event->description, 120) }}</p>
                        <div class="space-y-2 text-sm text-secondarytext mb-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $event->start_date->format('M d, Y') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $event->venue }}
                            </div>
                        </div>
                        <a href="{{ route('event-details', $event) }}" class="text-primary font-medium text-sm hover:underline">
                            View Details
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $events->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-secondarytext">No events found.</p>
            </div>
        @endif
    </div>
</section>
@endsection
