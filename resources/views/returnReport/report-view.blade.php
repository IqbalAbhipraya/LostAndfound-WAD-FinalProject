@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Return Report</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($reports as $report)
            @if(Auth::check() && Auth::user()->id === $report->founder_id || Auth::check() && Auth::user()->role === 'admin')
            <div class="block bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
                @if($report->image)
                    <img src="{{ asset('/storage/' . $report->image) }}" alt="{{ $report->owner_name }}" class="w-full h-48 object-cover rounded mb-4">
                @endif
                <h2 class="text-lg text-justify font-semibold text-gray-900">{{ $report->owner_name }}</h2>
                <p class="text-sm text-gray-700 mt-2 text-justify mb-2">{{ Str::limit($report->condition, 100) }}</p>
                @if($report->admin_acc === 'yes')
                  <p class="text-sm text-green-700 mt-2 text-justify mb-2">Admin Acc: Yes</p>
                @elseif($report->admin_acc === 'no')
                  <p class="text-sm text-red-700 mt-2 text-justify mb-2">Admin Acc: No</p>
                @elseif($report->admin_acc === 'pending')
                  <p class="text-sm text-yellow-700 mt-2 text-justify mb-2">Admin Acc: Pending</p>
                @endif


               @if(Auth::check() && Auth::user()->role === 'admin')
               <div class="flex items-center justify-between gap-5">
                  <a href="{{ route('return.edit', $report->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                     Edit/Acc
                  </a>
                  <form method="POST" action="{{ route('return.delete', $report) }}" >
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-full text-sm font-medium transition-colors duration-300 w-full">Delete</button>
                  </form>
               </div>
               @endif
            </div>
            @endif
        @empty
            <div class="col-span-4 text-center text-gray-600 font-medium">
                There are no Return Reports available.
            </div>
        @endforelse
    </div>
</div>

@endsection