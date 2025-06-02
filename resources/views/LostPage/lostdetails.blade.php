@extends('layouts.app')

@section('content')
<?php
    $lostItem->load('user', 'comments.commenter');
?>

<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6">
        <a href="{{ route('lost-items.index') }}"
           class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium transition-colors duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Lost Items
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 text-white ">
            <div class="flex items-center space-x-4 flex justify-between items-center">
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-bold mb-2">{{ $lostItem->itemname }}</h1>
                        @if(Auth::check() && Auth::user()->id === $lostItem->lostid)
                            <button onclick="location.href='{{ route('lost-items.edit', $lostItem->id) }}'" class="text-blue-100 hover:text-green-300 focus:outline-none">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title/><g id="Complete"><g id="edit"><g><path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></g></g></g></svg>
                            </button>
                        @endif
                    </div>

                    <p class="text-green-100 text-lg">Lost at {{ $lostItem->location }}</p>
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
                        <div class="card mt-4">
                            <div class="card-header">
                                Leave a Comment
                            </div>
                            <div class="card-body">
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="comments" class="form-label">Your Comment</label>
                                        <textarea class="form-control @error('comments') is-invalid @enderror" id="comments" name="comments" rows="3" placeholder="Write your comment here..." required>{{ old('comments') }}</textarea>
                                        @error('comments')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="item_id" value="{{ $lostItem->id }}">
                                    <input type="hidden" name="item_type" value="lost">

                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    @else 
                        <p class="text-center mt-4">Please <a href="{{ route('login') }}">login</a> to leave a comment.</p>
                    @endauth

                    <div class="mt-4">
                        <h3>Comments ({{ $lostItem->comments->count() }})</h3>

                        @forelse($lostItem->comments->sortByDesc('created_at') as $comment)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title mb-1">
                                        {{ $comment->commenter->name ?? 'User Tidak Dikenal' }}
                                    </h5>
                                    <p class="card-text mb-2">{{ $comment->comments }}</p>
                                    <small class="text-muted">Posted {{ $comment->created_at->diffForHumans() }}</small>

                                    @auth
                                        @if (Auth::id() == $comment->commenter_id || (Auth::user() && Auth::user()->user_type == 'admin'))
                                            <div class="mt-2">
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-outline-secondary me-2">Edit</a>

                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this comment? This action cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No comments yet. Be the first to comment!</p>
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
                    <div class="flex items-center gap-3 bg-blue-50 rounded-lg p-4">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <p class="text-gray-600">Item Owner</p>
                            </div>
                        </div>

                        <div class="border-t border-purple-200 pt-3">
                            <p class="text-sm text-gray-600 mb-2">Contact Information:</p>
                            <p class="font-medium text-purple-700">{{ $lostItem->lost_contact ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button onclick="showContact('{{ $lostItem->user->phone_number ?? 'Nomor tidak tersedia' }}')"
                            class="flex-1 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Contact Owner
                    </button>

                    <button onclick="copyContactInfo('{{ $lostItem->user->phone_number ?? 'Nomor tidak tersedia' }}')"
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

    </div>

    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-2xl max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Contact Owner</h3>
                <p class="text-gray-600 mb-4">Reach out to help return this item</p>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-gray-600 mb-2">Contact Information:</p>
                <p id="contactInfo" class="font-semibold text-lg text-blue-600 break-all"></p>
            </div>

            <div class="flex gap-3">
                <button onclick="copyContactInfo('{{ $lostItem->user->phone_number ?? 'Nomor tidak tersedia' }}')"
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