@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg mt-5">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold text-center mb-6">Add New Beach</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 mb-4 rounded-lg">
                <strong>Warning!</strong> There are some issues with the data you entered.<br><br>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('beaches.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Beach Name -->
                <div>
                    <label for="name" class="block text-base font-medium text-gray-700">Beach Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter beach name"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                        required>
                </div>

                <!-- Country -->
<div>
    <label for="country" class="block text-base font-medium text-gray-700">Country</label>
    <select name="country" id="country" class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out">
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
                    <input type="text" name="location" id="location" placeholder="Enter location"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-base font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" placeholder="Enter description"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"></textarea>
                </div>

                <!-- Image -->
                <div class="col-span-2">
                    <label for="image_url" class="block text-base font-medium text-gray-700">Image</label>
                    <input type="file" name="image_url" id="image_url" accept="image/*" onchange="previewImage(event)"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out">
                    <img id="image_preview" src="" alt="Image Preview" style="display: none; margin-top: 10px; max-width: 100%; border-radius: 8px;">
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
            <div class="text-center mt-6">
                <button type="submit"
                    class="bg-indigo-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-indigo-600 transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50">
                    Add Beach
                </button>
                <a href="{{ route('beaches.index') }}"
                    class="bg-gray-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-gray-600 transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ml-4">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var imagePreview = document.getElementById('image_preview');
            imagePreview.src = reader.result; // Set the image source to the uploaded file
            imagePreview.style.display = 'block'; // Show the image
        }
        reader.readAsDataURL(event.target.files[0]); // Read the selected file
    }
</script>
@endsection
