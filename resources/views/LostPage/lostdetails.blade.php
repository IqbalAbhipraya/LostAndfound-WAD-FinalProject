@extends('layouts.app')

@section('content')
<?php
    $lostItem->load('comments.commenter');
?>

<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6">
        <a href="{{ route('lost-items.index') }}"
           class="inline-flex items-center gap-2 text-red-600 hover:text-red-700 font-medium transition-colors duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Lost Items
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 text-white">
            <div class="flex items-center space-x-4 flex justify-between items-center">
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-bold mb-2">{{ $lostItem->itemname }}</h1>
                        @if(Auth::check() && (Auth::user()->id === $lostItem->userid || (Auth::user()->user_type ?? '') === 'admin'))
                            <div class="flex items-center gap-2">
                                <button onclick="location.href='{{ route('lost-items.edit', $lostItem->id) }}'" class="text-blue-100 hover:text-red-300 focus:outline-none">
                                    <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title/><g id="Complete"><g id="edit"><g><path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></g></g></g></svg>
                                </button>
                                
                                <form action="{{ route('lost-items.destroy', $lostItem->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this lost item? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-200 hover:text-red-100 focus:outline-none transition-colors duration-200"
                                            title="Delete Lost Item">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <p class="text-red-100 text-lg">Lost at {{ $lostItem->location }}</p>
                </div>

                <div class="flex-shrink-0 text-right">
                    <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                        <p class="text-sm font-medium">Lost Date</p>
                        <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($lostItem->lost_date)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Item Photo</h2>
                <div class="aspect-square bg-gray-100 rounded-xl overflow-hidden shadow-lg">
                    @if($lostItem->image)
                        <img src="{{ asset('/storage/' . $lostItem->image) }}"
                             alt="{{ $lostItem->itemname }}"
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

                                <input type="hidden" name="item_id" value="{{ $lostItem->id }}">
                                <input type="hidden" name="item_type" value="lost"> 

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
                        <h4 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Comments ({{ $lostItem->comments->count() }})</h4>

                        @forelse($lostItem->comments->sortByDesc('created_at') as $comment)
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
                            {{ $lostItem->description ?? 'No description provided for this item.' }}
                        </p>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">Location Lost</h2>
                    <div class="flex items-center gap-3 bg-red-50 rounded-lg p-4">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-gray-800">{{ $lostItem->location }}</p>
                            <p class="text-sm text-gray-600">Item was lost at this location</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">Reported By</h2>
                    <div class="bg-purple-50 rounded-lg p-4">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($lostItem->user->name ?? '?', 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 text-lg">{{ $lostItem->user->name ?? 'User Tidak Ditemukan' }}</h3>
                                <p class="text-gray-600">Item Reporter</p>
                            </div>
                        </div>

                        <div class="border-t border-purple-200 pt-3">
                            <p class="text-sm text-gray-600 mb-2">Contact Information:</p>
                            <p class="font-medium text-purple-700">{{ $lostItem->lost_contact ?? 'N/A' }}</p> {{-- Menggunakan lost_contact --}}
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button onclick="showContact('{{ $lostItem->lost_contact ?? 'Nomor tidak tersedia' }}')" {{-- Menggunakan lost_contact --}}
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Contact Reporter
                    </button>

                    <button onclick="copyContactInfo('{{ $lostItem->lost_contact ?? 'Nomor tidak tersedia' }}')" {{-- Menggunakan lost_contact --}}
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Copy Contact
                    </button>
                </div>

                @if(Auth::check() && (Auth::user()->id === $lostItem->userid || (Auth::user()->user_type ?? '') === 'admin'))
                <div class="border-t border-gray-200 pt-6">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <div class="flex-1">
                                <h4 class="font-medium text-red-800 mb-2">Delete This Lost Item</h4>
                                <p class="text-red-700 text-sm mb-4">
                                    Once deleted, this lost item report will be permanently removed and cannot be recovered.
                                </p>
                                <form action="{{ route('lost-items.destroy', $lostItem->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this lost item? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete Lost Item
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-yellow-800 mb-1">Found This Item?</h4>
                            <p class="text-yellow-700 text-sm">
                                If you found this item, please contact the owner using the information above.
                                Be prepared to provide details about where and when you found it.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> {{-- Penutup div Item Detail Card --}}

    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-2xl max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center mb-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Contact Reporter</h3>
                <p class="text-gray-600 mb-4">Reach out to help return this item</p>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600 mb-2">Contact Information:</p>
                <p id="contactInfo" class="font-semibold text-lg text-blue-600 break-all"></p>
            </div>

            <div class="flex gap-3">
                <button onclick="copyContactInfo('{{ $lostItem->lost_contact ?? 'Nomor tidak tersedia' }}')"
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