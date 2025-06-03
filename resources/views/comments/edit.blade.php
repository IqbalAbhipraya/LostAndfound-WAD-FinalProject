@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow-lg mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Comment</h2>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="comments" class="block text-gray-700 text-sm font-medium mb-2">Your Comment</label>
            <textarea 
                class="form-textarea w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 
                       @error('comments') border-red-500 @enderror" 
                id="comments" 
                name="comments" 
                rows="5" 
                placeholder="Edit your comment here..." 
                required>{{ old('comments', $comment->comments) }}</textarea>
            @error('comments')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ url()->previous() }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg 
                      focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition duration-300">
                Cancel
            </a>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg 
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300">
                Update Comment
            </button>
        </div>
    </form>
</div>
@endsection