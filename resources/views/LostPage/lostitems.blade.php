@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <!-- Page Title -->
        <h1 class="text-4xl font-bold text-green-800 text-center mb-8">Lost Items</h1>

        <!-- Search and Report Section -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-4 mb-10">
            <!-- Search Input -->
            <div class="relative w-full max-w-md">
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search by item name..."
                    class="w-full px-4 py-3 pr-12 border-2 border-green-300 rounded-full focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300"
                    onkeyup="searchItems()"
                >
                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <!-- Report Button -->
            <a href="{{ route('lost-items.create') }}">
                <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-medium transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex items-center gap-2">
                    Report
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </button>
            </a>
        </div>

        <!-- Items Grid -->
        <div id="itemsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($lostItems as $item)
            <!-- Item Card -->
            <div class="item-card bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 overflow-hidden size-fit">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-4 border-b border-gray-100 text-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            {{ strtoupper(substr($item->lost_name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-semibold">{{ $item->lost_name }}</h3>
                            <p class="text-xs">{{ \Carbon\Carbon::parse($item->lost_date)->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Item Image -->
                <div class="h-44 bg-gray-200 flex items-center justify-center overflow-hidden">
                    @if($item->image)
                        <img src="{{ asset('/storage/' . $item->image) }}"
                             alt="{{ $item->itemname }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-center text-gray-400">
                                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-sm">No Image</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Card Content -->
                <div class="p-5">
                    <h4 class="item-name font-bold text-lg text-gray-800 mb-1">{{ $item->itemname }}</h4>
                    <p class="item-location text-sm text-gray-600 mb-3">{{ $item->location }}</p>
                    <p class="item-description text-sm text-gray-700 leading-relaxed mb-4">
                        {{ Str::limit($item->description ?? 'No description available', 80) }}
                    </p>
                    
                    <div class="flex flex-col items-center justify-between gap-5">
                        <div class="flex items-center justify-between gap-5 w-full">
                            <button class="bg-purple-500 hover:bg-purple-600 text-white px-5 py-2 rounded-full text-sm font-medium transition-colors duration-300"
                                onclick="showContact('{{ $item->lost_contact }}')">
                                Contact
                            </button>
                            <a href="{{ route('lost-items.show', $item->id) }}"
                               class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                                View Details
                            </a>
                        </div>
                        @if(Auth::check() && Auth::user()->id === $item->lostid)
                        <button onclick="showDeleteModal({{ $item->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-full text-sm font-medium transition-colors duration-300 w-full">
                            Delete
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No lost items yet</h3>
                <p class="text-gray-500 mb-4">Be the first to report a lost item and help reunite it with its owner.</p>
                <a href="{{ route('lost-items.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors duration-300">
                    Report Lost Item
                </a>
            </div>
            @endforelse
        </div>

        <!-- No Results Message (Hidden by default) -->
        <div id="noResults" class="hidden col-span-full text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No items found</h3>
            <p class="text-gray-500 mb-4">Try adjusting your search terms or browse all items.</p>
            <button onclick="clearSearch()" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors duration-300">
                Show All Items
            </button>
        </div>

        <!-- Contact Modal (Hidden by default) -->
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
                <button onclick="hideContact()"
                        class="w-full bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-full transition-colors duration-300">
                    Close
                </button>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white p-6 rounded-2xl max-w-md w-full mx-4">
                <h3 class="text-lg font-bold mb-4">Confirm Deletion</h3>
                <p class="text-gray-700 mb-4">Are you sure you want to delete this item? This action cannot be undone.</p>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="hideDeleteModal()"
                                class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-full transition-colors duration-300">
                            Cancel
                        </button>
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-full transition-colors duration-300">
                            Delete
                        </button>
                    </div>
                </form>
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
            function searchItems() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
                const itemCards = document.querySelectorAll('.item-card');
                const itemsGrid = document.getElementById('itemsGrid');
                const noResults = document.getElementById('noResults');
                let visibleCount = 0;

                itemCards.forEach(card => {
                    const itemName = card.querySelector('.item-name').textContent.toLowerCase();
                    const itemLocation = card.querySelector('.item-location').textContent.toLowerCase();
                    const itemDescription = card.querySelector('.item-description').textContent.toLowerCase();

                    // Search in item name, location, and description
                    const matchesSearch = searchTerm === '' ||
                                        itemName.includes(searchTerm) ||
                                        itemLocation.includes(searchTerm) ||
                                        itemDescription.includes(searchTerm);

                    if (matchesSearch) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (visibleCount === 0 && searchTerm !== '') {
                    noResults.classList.remove('hidden');
                    itemsGrid.classList.add('mb-0');
                } else {
                    noResults.classList.add('hidden');
                    itemsGrid.classList.remove('mb-0');
                }
            }

            function clearSearch() {
                document.getElementById('searchInput').value = '';
                searchItems();
            }

            function showContact(contact) {
                document.getElementById('contactInfo').textContent = contact;
                document.getElementById('contactModal').classList.remove('hidden');
                document.getElementById('contactModal').classList.add('flex');
            }

            function hideContact() {
                document.getElementById('contactModal').classList.add('hidden');
                document.getElementById('contactModal').classList.remove('flex');
            }

            function showDeleteModal(item_id) {
                const form = document.getElementById('deleteForm');
                const templateUrlUntukDeleteV = "{{ route('lost-items.destroy', 'id') }}";
                form.action = templateUrlUntukDeleteV.replace('id', item_id);

                document.getElementById('deleteModal').classList.remove('hidden');
                document.getElementById('deleteModal').classList.add('flex');
            }

            function hideDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
                document.getElementById('deleteModal').classList.remove('flex');
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

            document.getElementById('deleteModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideDeleteModal();
                }
            });

            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchItems();
                }
            });
        </script>
    </div>
@endsection