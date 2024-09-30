@extends('layouts.master')

@section('content')
<x-page-title title="Beach Details" pagetitle="Beach" />

<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-center mb-6">{{ $beach->name }}</h2>

        <div class="space-y-4">
            <!-- Quốc Gia -->
            <div class="flex items-center">
                <label class="w-1/4 font-semibold text-gray-700">{{ __('Quốc Gia') }}:</label>
                <div class="w-3/4">
                    <p class="text-gray-600">{{ $beach->country }}</p>
                </div>
            </div>

            <!-- Vị Trí -->
            <div class="flex items-center">
                <label class="w-1/4 font-semibold text-gray-700">{{ __('Vị Trí') }}:</label>
                <div class="w-3/4">
                    <p class="text-gray-600">{{ $beach->location }}</p>
                </div>
            </div>

            <!-- Khu Vực -->
            <div class="flex items-center">
                <label class="w-1/4 font-semibold text-gray-700">{{ __('Khu Vực') }}:</label>
                <div class="w-3/4">
                    <p class="text-gray-600">{{ $beach->area ? $beach->area->name : 'Không xác định' }}</p>
                </div>
            </div>

            <!-- Mô Tả -->
            <div class="flex flex-col space-y-2">
                <label class="font-semibold text-gray-700">{{ __('Mô Tả') }}:</label>
                <p class="text-gray-600">{{ $beach->description }}</p>
                <p class="text-gray-600">{{ $beach->description2 }}</p>
                <p class="text-gray-600">{{ $beach->description3 }}</p>
            </div>

            <!-- Hình Ảnh -->
            @if($beach->image_url)
            <div class="flex flex-col items-start">
                <label class="font-semibold text-gray-700">{{ __('Hình Ảnh') }}:</label>
                <div>
                    <img src="{{ asset($beach->image_url) }}" alt="Hình Ảnh Bãi Biển" class="rounded-lg shadow-lg w-full md:w-1/2">
                </div>
            </div>
            @endif
        </div>

        <!-- Nút hành động -->
        <div class="mt-6 space-x-2">
            <form action="{{ route('beaches.destroy', $beach->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-700"
                    onclick="return confirm('{{ __('Bạn có chắc muốn xóa bãi biển này?') }}')">
                    {{ __('Xóa') }}
                </button>
            </form>
            <a href="{{ route('beaches.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-700">{{ __('Quay Lại') }}</a>
            <a href="{{ route('beaches.edit', $beach->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-600">{{ __('Sửa') }}</a>
        </div>
    </div>
</div>

@endsection
