@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6 m-10">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Item Condition Report</h2>
        
        <form id="itemForm" class="space-y-6" method="POST" action="{{ route('return.update', $reportData) }}" enctype="multipart/form-data">
            @csrf   
            @method('PUT') 
        <!-- Owner Name -->
            <div>
                <label for="owner_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Owner Name
                </label>
                <input 
                    type="text" 
                    id="owner_name" 
                    name="owner_name" 
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Enter owner's full name"
                    value="{{ $reportData->owner_name }}"
                >
            </div>

            <!-- Condition Description -->
            <div>
                <label for="condition" class="block text-sm font-medium text-gray-700 mb-2">
                    Condition Description
                </label>
                <textarea 
                    id="condition" 
                    name="condition" 
                    required
                    rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-vertical"
                    placeholder="Describe the current condition of the item in detail..."
                    
                >{{ $reportData->condition }}</textarea>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Item Image
                </label>
                <div class="mb-6">
                    <p class="text-sm text-gray-500">Current Image Preview:</p>
                <img src="{{ asset('/storage/' . $reportData->image) }}" alt="Image Report" class="w-64 h-auto rounded mt-2">
            </div>
                <input type="hidden" id="image" name="image" value="{{ $reportData->image }}"> 
            </div>
            <div>
                <label for="admin_acc" class="block text-sm font-medium text-gray-700 mb-2">
                    Acc Return Report
                </label>
                <select id="admin_acc" name="admin_acc" class="form-select w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required>
                    <option value="Yes" {{ old('admin_acc', isset($lostItem) ? $reportData->admin_acc : 'pending') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('admin_acc', isset($lostItem) ? $reportData->admin_acc : 'pending') == 'No' ? 'selected' : '' }}>No</option>
                    <option value="Pending" {{ old('admin_acc', isset($lostItem) ? $reportData->admin_acc : 'pending') == 'No' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button 
                    type="submit" 
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Submit Report
                </button>
            </div>
        </form>
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
    </script>

@endsection