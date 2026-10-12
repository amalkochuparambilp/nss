@extends('layouts.public')

@section('title', $event->title)

@section('content')
<section class="bg-primary text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-xs font-semibold text-accent uppercase mb-2">{{ $event->category }}</div>
        <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $event->title }}</h1>
        <div class="flex flex-col md:flex-row gap-4 text-white/80">
            <span class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $event->start_date->format('M d, Y') }} - {{ $event->end_date->format('M d, Y') }}
            </span>
            <span class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                {{ $event->venue }}
            </span>
        </div>
    </div>
</section>

<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-card rounded-xl p-8 shadow-sm">
            <h2 class="text-xl font-bold text-primary mb-4">About This Event</h2>
            <p class="text-secondarytext mb-6">{{ $event->description }}</p>

            @if($event->eligibility_conditions)
                <h3 class="font-semibold text-primary mb-2">Eligibility</h3>
                <p class="text-secondarytext mb-6">{{ $event->eligibility_conditions }}</p>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-surface rounded-lg p-4">
                    <h4 class="font-semibold mb-2">Capacity</h4>
                    <p class="text-secondarytext">{{ $event->capacity }} participants</p>
                </div>
                <div class="bg-surface rounded-lg p-4">
                    <h4 class="font-semibold mb-2">Registration Deadline</h4>
                    <p class="text-secondarytext">
                        {{ $event->registration_deadline?->format('M d, Y') ?? 'No deadline' }}
                    </p>
                </div>
            </div>

            @auth
                @if(auth()->user()->hasRole('volunteer'))
                    <a href="{{ route('volunteer.events.show', $event) }}" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary/90 transition inline-block">
                        Register for Event
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary/90 transition inline-block">
                    Login to Register
                </a>
            @endauth
        </div>
    </div>
</section>
@endsection
