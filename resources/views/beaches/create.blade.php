@extends('layouts.master')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold text-center mb-6">Thêm Bãi Biển Mới</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 mb-4 rounded-lg">
                <strong>Cảnh báo!</strong> Có một số vấn đề với dữ liệu bạn nhập.<br><br>
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
                <!-- Tên Bãi Biển -->
                <div>
                    <label for="name" class="block text-base font-medium text-gray-700">Tên Bãi Biển</label>
                    <input type="text" name="name" id="name" placeholder="Nhập tên bãi biển"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"
                        required>
                </div>

                <!-- Quốc Gia -->
                <div>
                    <label for="country" class="block text-base font-medium text-gray-700">Quốc Gia</label>
                    <input type="text" name="country" id="country" placeholder="Nhập quốc gia"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out">
                </div>

                <!-- Vị Trí -->
                <div>
                    <label for="location" class="block text-base font-medium text-gray-700">Vị Trí</label>
                    <input type="text" name="location" id="location" placeholder="Nhập vị trí"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out">
                </div>

                <!-- Mô Tả -->
                <div>
                    <label for="description" class="block text-base font-medium text-gray-700">Mô Tả</label>
                    <textarea name="description" id="description" rows="3" placeholder="Nhập mô tả"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"></textarea>
                </div>

                <!-- Nút thêm mô tả bổ sung -->
                <div class="col-span-2">
                    <button type="button" class="bg-indigo-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-indigo-600 transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50" id="add-description-btn">
                        <i class="fas fa-plus"></i> Thêm Mô Tả Bổ Sung
                    </button>
                </div>

                <!-- Mô Tả 2 - Ẩn mặc định -->
                <div id="description2-container" style="display: none;" class="col-span-2">
                    <label for="description2" class="block text-base font-medium text-gray-700">Mô Tả 2</label>
                    <textarea name="description2" id="description2" rows="3" placeholder="Nhập mô tả bổ sung"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"></textarea>
                </div>

                <!-- Mô Tả 3 - Ẩn mặc định -->
                <div id="description3-container" style="display: none;" class="col-span-2">
                    <label for="description3" class="block text-base font-medium text-gray-700">Mô Tả 3</label>
                    <textarea name="description3" id="description3" rows="3" placeholder="Nhập mô tả bổ sung"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out"></textarea>
                </div>

                <!-- Hình Ảnh -->
                <div class="col-span-2">
                    <label for="image_url" class="block text-base font-medium text-gray-700">Hình Ảnh</label>
                    <input type="file" name="image_url" id="image_url" accept="image/*"
                        class="mt-1 w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out">
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="text-center mt-6">
                <button type="submit"
                    class="bg-indigo-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-indigo-600 transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50">
                    Thêm Bãi Biển
                </button>
                <a href="{{ route('beaches.index') }}"
                    class="bg-gray-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-gray-600 transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ml-4">
                    Hủy
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var addDescriptionBtn = document.getElementById('add-description-btn');
        var description2Container = document.getElementById('description2-container');
        var description3Container = document.getElementById('description3-container');
        var descriptionStep = 0;

        addDescriptionBtn.addEventListener('click', function () {
            descriptionStep++;

            if (descriptionStep === 1) {
                description2Container.style.display = 'block';
            } else if (descriptionStep === 2) {
                description3Container.style.display = 'block';
                addDescriptionBtn.style.display = 'none'; // Ẩn nút sau khi hiển thị mô tả 3
            }
        });
    });
</script>
@endsection
