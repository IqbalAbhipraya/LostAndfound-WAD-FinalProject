@extends('layouts.app')

@section('content')
<?php
    // Hanya memuat relasi 'comments' dan 'commenter' karena info user akan diambil langsung dari item
    $foundItem->load('comments.commenter');
?>

<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6">
        <a href="{{ route('found.index') }}"
           class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium transition-colors duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Found Items'
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 text-white">
            <div class="flex items-center space-x-4 flex justify-between items-center">
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-bold mb-2">{{ $foundItem->itemname }}</h1>
                        @if(Auth::check() && (Auth::user()->id === $foundItem->founderid || (Auth::user()->user_type ?? '') === 'admin'))
                            <div class="flex items-center gap-2">
                                <button onclick="location.href='{{ route('found.edit', $foundItem->id) }}'" class="text-blue-100 hover:text-green-300 focus:outline-none">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title/><g id="Complete"><g id="edit"><g><path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></g></g></g></svg>
                                </button>
                                
                                <form action="{{ route('found.destroy', $foundItem->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this found item? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-200 hover:text-red-100 focus:outline-none transition-colors duration-200"
                                            title="Delete Found Item">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <p class="text-green-100 text-lg">Found at {{ $foundItem->location }}</p>
                </div>

                <div class="flex-shrink-0 text-right">
                    <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                        <p class="text-sm font-medium">Found Date</p>
                        <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($foundItem->found_date)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Item Photo</h2>
                <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                    @if($foundItem->image)
                        <img src="{{ asset('/storage/' . $foundItem->image) }}"
                             alt="{{ $foundItem->itemname }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-center text-gray-400">
                                <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No Image Available</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-8 p-4 bg-gray-50 rounded-lg shadow-sm">
                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @auth
                        <div class="bg-white p-6 rounded-xl shadow-lg mt-6 border border-gray-200">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Leave a Comment</h4>
                            
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf 

                                <div class="mb-3">
                                    <label for="comments" class="block text-gray-700 text-sm font-medium mb-2">Your Comment</label>
                                    <textarea 
                                        class="form-textarea w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 
                                               @error('comments') border-red-500 @enderror" 
                                        id="comments" 
                                        name="comments" 
                                        rows="4" 
                                        placeholder="Write your comment here..." 
                                        required>{{ old('comments') }}</textarea>
                                    @error('comments')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <input type="hidden" name="item_id" value="{{ $foundItem->id }}">
                                <input type="hidden" name="item_type" value="found"> 

                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg 
                                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300">
                                    Post Comment
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="text-center mt-4">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">login</a> to leave a comment.</p>
                    @endauth

                    <div class="bg-white p-6 rounded-xl shadow-lg mt-6 border border-gray-200">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Comments ({{ $foundItem->comments->count() }})</h4>

                        @forelse($foundItem->comments->sortByDesc('created_at') as $comment)
                            <div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                                <div class="flex items-start mb-2">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-700 font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($comment->commenter->name ?? '?', 0, 1)) }}
                                    </div>
                                    <div class="ml-3 flex-grow">
                                        <p class="font-semibold text-gray-800">{{ $comment->commenter->name ?? 'User Tidak Dikenal' }}</p>
                                        <p class="text-gray-500 text-xs">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-base leading-relaxed mb-3">{{ $comment->comments }}</p>

                                @auth
                                    @if (Auth::id() == $comment->commenter_id || (Auth::user() && (Auth::user()->user_type ?? '') === 'admin'))
                                        <div class="flex space-x-2 text-sm">
                                            <a href="{{ route('comments.edit', $comment->id) }}" 
                                               class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                            
                                            <span class="text-gray-400">|</span>

                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this comment? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-800 font-medium bg-transparent border-none p-0 cursor-pointer">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        @empty
                            <p class="text-gray-600 text-center py-4">No comments yet. Be the first to comment!</p>
                        @endforelse
                    </div>
                </div>

            </div>

            <div class="space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">Description</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 leading-relaxed">
                            {{ $foundItem->description ?? 'No description provided for this item.' }}
                        </p>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">Location Found</h2>
                    <div class="flex items-center gap-3 bg-blue-50 rounded-lg p-4">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-800">{{ $foundItem->location }}</p>
                            <p class="text-sm text-gray-600">Item was found at this location</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">Found By</h2>
                    <div class="bg-purple-50 rounded-lg p-4">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($foundItem->founder_name ?? '?', 0, 1)) }} {{-- Menggunakan founder_name --}}
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 text-lg">{{ $foundItem->founder_name ?? 'User Tidak Ditemukan' }}</h3> {{-- Menggunakan founder_name --}}
                                <p class="text-gray-600">Item Finder</p>
                            </div>
                        </div>

                        <div class="border-t border-purple-200 pt-3">
                            <p class="text-sm text-gray-600 mb-2">Contact Information:</p>
                            <p class="font-medium text-purple-700">{{ $foundItem->founder_contact ?? 'N/A' }}</p> {{-- Menggunakan founder_contact --}}
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button onclick="showContact('{{ $foundItem->founder_contact ?? 'Nomor tidak tersedia' }}')" {{-- Menggunakan founder_contact --}}
                            class="flex-1 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Contact Finder
                    </button>

                    <button onclick="copyContactInfo('{{ $foundItem->founder_contact ?? 'Nomor tidak tersedia' }}')" {{-- Menggunakan founder_contact --}}
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Copy Contact
                    </button>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-yellow-800 mb-1">Lost Something?</h4>
                            <p class="text-yellow-700 text-sm">
                                If this is your item, please contact the finder using the information above.
                                Be prepared to provide proof of ownership.
                            </p>
                        </div>
                    </div>
                </div>

                @if(Auth::check() && (Auth::user()->id === $foundItem->founderid || (Auth::user()->user_type ?? '') === 'admin'))
                <div class="border-t border-gray-200 pt-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <div class="flex-1">
                                <h4 class="font-medium text-red-800 mb-2">Delete This Found Item</h4>
                                <p class="text-red-700 text-sm mb-4">
                                    Once deleted, this found item report will be permanently removed and cannot be recovered.
                                </p>
                                <form action="{{ route('found.destroy', $foundItem->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this found item? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete Found Item
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div> {{-- Penutup div Item Detail Card --}}

    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-2xl max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Contact Finder</h3>
                <p class="text-gray-600 mb-4">Reach out to claim your item</p>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600 mb-2">Contact Information:</p>
                <p id="contactInfo" class="font-semibold text-lg text-blue-600 break-all"></p>
            </div>

            <div class="flex gap-3">
                <button onclick="copyContactInfo('{{ $foundItem->founder_contact ?? 'Nomor tidak tersedia' }}')"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg font-medium transition-colors duration-300">
                    Copy
                </button>
                <button onclick="hideContact()"
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg font-medium transition-colors duration-300">
                    Close
                </button>
            </div>
        </div>
    </div>

    <div id="copyToast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Contact information copied!
        </div>
    </div>

    <script>
        function showContact(contact) {
            document.getElementById('contactInfo').textContent = contact;
            document.getElementById('contactModal').classList.remove('hidden');
            document.getElementById('contactModal').classList.add('flex');
        }

        function hideContact() {
            document.getElementById('contactModal').classList.add('hidden');
            document.getElementById('contactModal').classList.remove('flex');
        }

        function copyContactInfo(contact) {
            navigator.clipboard.writeText(contact).then(function() {
                const toast = document.getElementById('copyToast');
                toast.classList.remove('translate-x-full');

                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                }, 3000);

                hideContact();
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
                const textArea = document.createElement('textarea');
                textArea.value = contact;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                const toast = document.getElementById('copyToast');
                toast.classList.remove('translate-x-full');
                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                }, 3000);

                hideContact();
            });
        }

        document.getElementById('contactModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideContact();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideContact();
            }
        });
    </script>
</div>
@endsection