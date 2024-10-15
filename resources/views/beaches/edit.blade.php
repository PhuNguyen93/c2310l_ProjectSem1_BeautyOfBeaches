@extends('layouts.master')

@section('content')
    <x-page-title title="Beach Edit" pagetitle="Beach" />

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-semibold text-center mb-6">Edit Beach</h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-4 mb-4 rounded-lg">
                    <strong>Warning !</strong> There're some problems with your typing.<br><br>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('beaches.update', $beach->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
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
                        <select name="country" id="country"
                            class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out">
                            <option value="" disabled selected>Select a country</option>
                            <option value="">Select a country</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="India">India</option>
                            <option value="United States">United States</option>
                            <option value="Germany">Germany</option>
                            <option value="Australia">Australia</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Italy">Italy</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Greece">Greece</option>
                            <option value="Spain">Spain</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Philippines">Philippines</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Egypt">Egypt</option>
                        </select>
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

                    <div>
                        <label for="image_url" class="block text-base font-medium text-gray-700">Main Image</label>
                        <input type="file" name="image_url" id="image_url"
                            class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                            accept="image/*" onchange="previewImage(event)">
                        <img id="image-preview" src="{{ asset($beach->image_url) }}" alt="Beach Image"
                            class="mt-4 w-48 h-32 rounded-lg object-cover {{ !$beach->image_url ? 'hidden' : '' }}">
                    </div>

                    <div class="col-span-2">
                        <label for="gallery" class="block text-base font-medium text-gray-700">Additional Images</label>
                        <input type="file" name="gallery[]" id="gallery" multiple
                            class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                            accept="image/*" onchange="previewGallery(event)">
                        <div id="gallery-preview" class="mt-4 flex space-x-4">
                            @foreach ($beach->gallery as $image)
                                <img src="{{ asset($image->image_url) }}" alt="Gallery Image"
                                    class="w-24 h-24 object-cover rounded-lg">
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Longitude và Latitude -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="longitude" class="block text-base font-medium text-gray-700">Longitude</label>
                        <input type="number" name="longitude" id="longitude" placeholder="Enter longitude"
                            value="{{ old('longitude', $beach->longitude) }}"
                            class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                            step="0.0000001">
                    </div>

                    <div>
                        <label for="latitude" class="block text-base font-medium text-gray-700">Latitude</label>
                        <input type="number" name="latitude" id="latitude" placeholder="Enter latitude"
                            value="{{ old('latitude', $beach->latitude) }}"
                            class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                            step="0.0000001">
                    </div>
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
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function previewGallery(event) {
        var files = event.target.files;
        var galleryPreview = document.getElementById('gallery-preview');
        galleryPreview.innerHTML = ''; // Clear existing preview
        Array.from(files).forEach(function(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-24 h-24 object-cover rounded-lg';
                galleryPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
