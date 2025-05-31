@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Return Report</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($reports as $report)
            <div class="block bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
                @if($report->image)
                    <img src="{{ asset('/' . $report->image) }}" alt="{{ $report->owner_name }}" class="w-full h-48 object-cover rounded mb-4">
                @endif
                <h2 class="text-lg text-justify font-semibold text-gray-900">{{ $report->owner_name }}</h2>
                <p class="text-sm text-gray-700 mt-2 text-justify mb-2">{{ Str::limit($report->condition, 100) }}</p>
            </div>
        @empty
            <div class="col-span-4 text-center text-gray-600 font-medium">
                There are no articles available.
            </div>
        @endforelse
    </div>
</div>

@endsection