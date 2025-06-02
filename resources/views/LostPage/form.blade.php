@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6 m-10">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
            {{ isset($lostItem) ? 'Edit Lost Item' : 'Report Lost Item' }}
        </h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="space-y-6" action="{{ isset($lostItem) ? route('lost-items.update', $lostItem->id) : route('lost-items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($lostItem))
                @method('PUT')
            @endif
            <!-- Item Name -->
            <div>
                <label for="itemname" class="block text-sm font-medium text-gray-700 mb-2">
                    Item Name
                </label>
                <input
                    type="text"
                    id="itemname"
                    name="itemname"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                    placeholder="What item did you lose?"
                    value="{{ old('itemname', isset($lostItem) ? $lostItem->itemname : '') }}"
                >
            </div>

            <!-- Item Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Item Description
                </label>
                <textarea
                    id="description"
                    name="description"
                    required
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-vertical"
                    placeholder="Describe the item in detail (color, brand, size, etc.)..."
                >{{ old('description', isset($lostItem) ? $lostItem->description : '') }}</textarea>
            </div>

            <!-- Lost Date -->
            <div>
                <label for="lost_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Date Lost
                </label>
                <input
                    type="date"
                    id="lost_date"
                    name="lost_date"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                    value="{{ old('lost_date', isset($lostItem) ? $lostItem->lost_date : '') }}"
                >
            </div>

            <!-- Your Name -->
            <div>
                <label for="lost_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Your Name
                </label>
                <input
                    type="text"
                    id="lost_name"
                    name="lost_name"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors {{ auth()->check() && auth()->user()->name ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                    placeholder="Enter your full name"
                    value="{{ old('lost_name', isset($lostItem) ? $lostItem->lost_name : (auth()->check() && auth()->user()->name ? auth()->user()->name : '')) }}"
                    @if(auth()->check() && auth()->user()->name) readonly @endif
                >
                @if(auth()->check() && auth()->user()->name)
                    <p class="text-sm text-gray-500 mt-1">This field is automatically filled with your registered name and cannot be changed.</p>
                @endif
            </div>

            <!-- Your Contact -->
            <div>
                <label for="lost_contact" class="block text-sm font-medium text-gray-700 mb-2">
                    Your Contact Information
                </label>
                <input
                    type="text"
                    id="lost_contact"
                    name="lost_contact"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                    placeholder="Enter your phone number"
                    value="{{ old('lost_contact', isset($lostItem) ? $lostItem->lost_contact : '') }}"
                >
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                    Location Lost
                </label>
                <input
                    type="text"
                    id="location"
                    name="location"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                    placeholder="Where did you lose this item?"
                    value="{{ old('location', isset($lostItem) ? $lostItem->location : '') }}"
                >
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Item Photo
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                <span>Upload a photo</span>
                                <input id="image" name="image" type="file" accept="image/*" {{ isset($lostItem) ? '' : 'required' }} class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
                <div id="imagePreview" class="mt-4 hidden">
                    <img id="previewImg" src="" alt="Preview" class="max-w-full h-32 object-cover rounded-md border border-gray-300">
                    <p id="fileName" class="text-sm text-gray-600 mt-2"></p>
                </div>
            </div>

            <!-- Your ID -->
            <div>
                <label for="lostid" class="block text-sm font-medium text-gray-700 mb-2">
                    Your ID
                </label>
                <input
                    type="text"
                    id="lostid"
                    name="lostid"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                    placeholder="Student/Employee ID"
                    value="{{ old('lostid', isset($lostItem) ? $lostItem->lostid : (auth()->check() ? auth()->user()->id : '')) }}"
                    @if(auth()->check()) readonly @endif
                >
                @if(auth()->check())
                    <p class="text-sm text-gray-500 mt-1">This field is automatically filled with your user ID and cannot be changed.</p>
                @endif
            </div>

            <!-- Claim Status -->
            <div>
                <label for="claim_status" class="block text-sm font-medium text-gray-700 mb-2">
                    Claim Status
                </label>
                <select id="claim_status" name="claim_status" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
                    <option value="unclaimed" {{ old('claim_status', isset($lostItem) ? $lostItem->claim_status : '') == 'unclaimed' ? 'selected' : '' }}>Unclaimed</option>
                    <option value="claimed" {{ old('claim_status', isset($lostItem) ? $lostItem->claim_status : '') == 'claimed' ? 'selected' : '' }}>Claimed</option>
                </select>
            </div>

            <!-- Claimed At -->
            <div>
                <label for="claimed_at" class="block text-sm font-medium text-gray-700 mb-2">
                    Claimed At
                </label>
                <input
                    type="date"
                    id="claimed_at"
                    name="claimed_at"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                    value="{{ old('claimed_at', isset($lostItem) ? $lostItem->claimed_at : '') }}"
                >
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                >
                    {{ isset($lostItem) ? 'Update Lost Item' : 'Report Lost Item' }}
                </button>
            </div>
        </form>

        <!-- Success Message -->
        <div id="successMessage" class="hidden mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            <div class="flex">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Lost item reported successfully! We will help you find it.</span>
            </div>
        </div>
        @if(isset($lostItem) && Auth::check() && Auth::user()->id == $lostItem->userid)
        <!-- Delete Button for Edit Page -->
        <form action="{{ route('lost-items.destroy', $lostItem->id) }}" method="POST" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit"
                onclick="return confirm('Are you sure you want to delete this lost item? This action cannot be undone.');"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Delete Lost Item
            </button>
        </form>
        @endif
    </div>

    <script>
        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const fileName = document.getElementById('fileName');

        if(imageInput){
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        fileName.textContent = file.name;
                        imagePreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Drag and drop functionality
        const dropZone = document.querySelector('.border-dashed');
        if(dropZone){
            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropZone.classList.add('border-green-400', 'bg-green-50');
            });

            dropZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                dropZone.classList.remove('border-green-400', 'bg-green-50');
            });

            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropZone.classList.remove('border-green-400', 'bg-green-50');

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    imageInput.files = files;
                    const event = new Event('change', { bubbles: true });
                    imageInput.dispatchEvent(event);
                }
            });
        }
    </script>
@endsection