@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6 m-10">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Report Found Item</h2>

        <form class="space-y-6" action="{{ route('found.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                    placeholder="What item did you find?"
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
                ></textarea>
            </div>

            <!-- Founder Name -->
            <div>
                <label for="founder_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Your Name
                </label>
                <input
                    type="text"
                    id="founder_name"
                    name="founder_name"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                    placeholder="Enter your full name"
                >
            </div>

            <!-- Founder Contact -->
            <div>
                <label for="founder_contact" class="block text-sm font-medium text-gray-700 mb-2">
                    Your Contact Information
                </label>
                <input
                    type="text"
                    id="founder_contact"
                    name="founder_contact"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                    placeholder="Phone number or email address"
                >
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                    Location Found
                </label>
                <input
                    type="text"
                    id="location"
                    name="location"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                    placeholder="Where did you find this item?"
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
                                <input id="image" name="image" type="file" accept="image/*" required class="sr-only">
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

            <!-- Submit Button -->
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                >
                    Report Found Item
                </button>
            </div>
        </form>

        <!-- Success Message -->
        <div id="successMessage" class="hidden mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            <div class="flex">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Found item reported successfully! The owner will be able to find it now.</span>
            </div>
        </div>
    </div>

    <script>
        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const fileName = document.getElementById('fileName');

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

        // Form submission
        const form = document.getElementById('foundItemForm');
        const successMessage = document.getElementById('successMessage');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(form);
            const data = {
                item_name: formData.get('item_name'),
                item_description: formData.get('item_description'),
                founder_name: formData.get('founder_name'),
                founder_contact: formData.get('founder_contact'),
                location: formData.get('location'),
                image: formData.get('image').name
            };

            console.log('Found item form submitted with data:', data);

            // Show success message
            successMessage.classList.remove('hidden');

            // Reset form after a delay
            setTimeout(() => {
                form.reset();
                imagePreview.classList.add('hidden');
                successMessage.classList.add('hidden');
            }, 4000);
        });

        // Drag and drop functionality
        const dropZone = document.querySelector('.border-dashed');

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
    </script>
@endsection
