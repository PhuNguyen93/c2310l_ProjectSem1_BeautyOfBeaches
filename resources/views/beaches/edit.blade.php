@extends('layouts.master')

@section('content')
<x-page-title title="Beach Edit" pagetitle="Beach" />

<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold text-center mb-6">Edit Beach</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 mb-4 rounded-lg">
                <strong>Warning !</strong>There're some problems with your typing.<br><br>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('beaches.update', $beach->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Beach Name -->
                <div>
                    <label for="name" class="block text-base font-medium text-gray-700">Beach Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $beach->name) }}"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                        required placeholder="Enter the beach name">
                </div>

                <!-- Country -->
                <div>
                    <label for="country" class="block text-base font-medium text-gray-700">Country</label>
                    <input type="text" name="country" id="country" value="{{ old('country', $beach->country) }}"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                        placeholder="Enter the country">
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-base font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $beach->location) }}"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                        placeholder="Enter the location">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-base font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                        rows="3" placeholder="Enter the description">{{ old('description', $beach->description) }}</textarea>
                </div>

                <!-- Description 2 -->
                {{-- <div>
                    <label for="description2" class="block text-base font-medium text-gray-700">Description 2</label>
                    <textarea name="description2" id="description2"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                        rows="3" placeholder="Enter the second description">{{ old('description2', $beach->description2) }}</textarea>
                </div>

                <!-- Description 3 -->
                <div>
                    <label for="description3" class="block text-base font-medium text-gray-700">Description 3</label>
                    <textarea name="description3" id="description3"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                        rows="3" placeholder="Enter the third description">{{ old('description3', $beach->description3) }}</textarea>
                </div> --}}

                <!-- Image -->
                <div>
                    <label for="image_url" class="block text-base font-medium text-gray-700">Image</label>
                    <input type="file" name="image_url" id="image_url"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                        accept="image/*" onchange="previewImage(event)">
                    <!-- Hình ảnh preview -->
                    <img id="image-preview" src="{{ asset($beach->image_url) }}" alt="Beach Image"
                        class="mt-4 w-48 h-32 rounded-lg object-cover {{ !$beach->image_url ? 'hidden' : '' }}">
                </div>
            </div>
            <!-- Longitude -->
<div class="col-span-2">
    <label for="longitude" class="block text-base font-medium text-gray-700">Longitude</label>
    <input type="number" name="longitude" id="longitude" placeholder="Enter longitude"
        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
        step="0.0000001">

<!-- Latitude -->
<div class="col-span-2">
    <label for="latitude" class="block text-base font-medium text-gray-700">Latitude</label>
    <input type="number" name="latitude" id="latitude" placeholder="Enter latitude"
        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
        step="0.0000001">
</div>
            <!-- Action Buttons -->
            <div class="flex justify-center space-x-4 mt-6">
                <button type="submit"
                    class="bg-indigo-500 text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50 transition ease-in-out duration-150">
                    Update Beach
                </button>
                <a href="{{ route('beaches.index') }}"
                    class="bg-gray-500 text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 transition ease-in-out duration-150">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.classList.remove('hidden'); // Hiển thị hình ảnh mới
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
