@extends('layouts.public')

@section('title', 'Impact Stories')

@section('content')
<section class="bg-primary text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-4">Impact Stories</h1>
        <p class="text-white/80 text-lg max-w-2xl">
            Stories of change, service, and community transformation through NSS activities.
        </p>
    </div>
</section>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($approvedReports->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($approvedReports as $report)
                    <div class="bg-card rounded-xl p-6 shadow-sm hover:shadow-md transition">
                        <h3 class="font-semibold text-lg mb-2">{{ $report->title }}</h3>
                        <p class="text-secondarytext text-sm mb-4">{{ Str::limit($report->description, 150) }}</p>
                        <div class="text-xs text-secondarytext space-y-1">
                            <div>{{ $report->activity_date->format('M d, Y') }}</div>
                            <div>{{ $report->venue }}</div>
                            <div>{{ $report->participant_count }} participants</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $approvedReports->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-secondarytext">No impact stories published yet.</p>
            </div>
        @endif
    </div>
</section>
@endsection
