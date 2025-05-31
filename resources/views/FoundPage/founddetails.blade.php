@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('found.index') }}"
           class="inline-flex items-center gap-2 text-green-600 hover:text-green-700 font-medium transition-colors duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Found Items
        </a>
    </div>

    <!-- Item Detail Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $foundItem->itemname }}</h1>
                    <p class="text-green-100 text-lg">Found at {{ $foundItem->location }}</p>
                </div>
                <div class="text-right">
                    <div class="bg-white bg-opacity-20 rounded-full px-4 py-2">
                        <p class="text-sm font-medium">Found Date</p>
                        <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($foundItem->found_date)->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            <!-- Item Image -->
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
            </div>

            <!-- Item Details -->
            <div class="space-y-6">
                <!-- Description -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">Description</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 leading-relaxed">
                            {{ $foundItem->description ?? 'No description provided for this item.' }}
                        </p>
                    </div>
                </div>

                <!-- Location Details -->
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

                <!-- Finder Information -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">Found By</h2>
                    <div class="bg-purple-50 rounded-lg p-4">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($foundItem->founder_name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 text-lg">{{ $foundItem->founder_name }}</h3>
                                <p class="text-gray-600">Item Finder</p>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="border-t border-purple-200 pt-3">
                            <p class="text-sm text-gray-600 mb-2">Contact Information:</p>
                            <p class="font-medium text-purple-700">{{ $foundItem->founder_contact }}</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button onclick="showContact('{{ $foundItem->founder_contact }}')"
                            class="flex-1 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Contact Finder
                    </button>

                    <button onclick="copyContactInfo('{{ $foundItem->founder_contact }}')"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Copy Contact
                    </button>
                </div>

                <!-- Additional Info -->
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
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
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
                <button onclick="copyContactInfo('{{ $foundItem->founder_contact }}')"
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

    <!-- Copy Success Toast -->
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
                // Show success toast
                const toast = document.getElementById('copyToast');
                toast.classList.remove('translate-x-full');

                // Hide toast after 3 seconds
                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                }, 3000);

                // Close modal if it's open
                hideContact();
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = contact;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);

                // Show success toast
                const toast = document.getElementById('copyToast');
                toast.classList.remove('translate-x-full');
                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                }, 3000);

                hideContact();
            });
        }

        // Close modal when clicking outside
        document.getElementById('contactModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideContact();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideContact();
            }
        });
    </script>
</div>
@endsection
