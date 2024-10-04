@extends('layouts.master')

@section('content')
<x-page-title title="Beach Details" pagetitle="Beach" />

<div class="bg-white p-8 rounded-lg shadow-lg">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 text-indigo-800">{{ $beach->name }}</h2>

        <div class="space-y-6">
            <!-- Country -->
            <div class="flex items-center">
                <label class="w-1/4 font-semibold text-gray-800">{{ __('Country') }}:</label>
                <div class="w-3/4">
                    <p class="text-gray-700">{{ $beach->country }}</p>
                </div>
            </div>

            <!-- Location -->
            <div class="flex items-center">
                <label class="w-1/4 font-semibold text-gray-800">{{ __('Location') }}:</label>
                <div class="w-3/4">
                    <p class="text-gray-700">{{ $beach->location }}</p>
                </div>
            </div>

            <!-- Area -->
            <div class="flex items-center">
                <label class="w-1/4 font-semibold text-gray-800">{{ __('Area') }}:</label>
                <div class="w-3/4">
                    <p class="text-gray-700">{{ $beach->area ? $beach->area->name : 'Undefined' }}</p>
                </div>
            </div>

            <!-- Description -->
            <div class="flex flex-col space-y-4">
                <label class="font-semibold text-gray-800">{{ __('Description') }}:</label>
                <p class="text-gray-700">{{ $beach->description }}</p>
                <p class="text-gray-700">{{ $beach->description2 }}</p>
                <p class="text-gray-700">{{ $beach->description3 }}</p>
            </div>

            <!-- Image -->
            @if($beach->image_url)
            <div class="flex flex-col items-start">
                <label class="font-semibold text-gray-800">{{ __('Image') }}:</label>
                <div class="w-full md:w-1/2">
                    <img src="{{ asset($beach->image_url) }}" alt="Beach Image" class="rounded-lg shadow-lg w-full">
                </div>
            </div>
            @endif
        </div>

        <!-- Action buttons -->
        <div class="mt-8 flex justify-between items-center">
            <div class="flex space-x-6">
                <form action="{{ route('beaches.destroy', $beach->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-red-600 transition"
                        onclick="return confirm('{{ __('Are you sure you want to delete this beach?') }}')">
                        {{ __('Delete') }}
                    </button>
                </form>
                <a href="{{ route('beaches.edit', $beach->id) }}" class="bg-yellow-400 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-yellow-500 transition">{{ __('Edit') }}</a>
            </div>
            <a href="{{ route('beaches.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-gray-600 transition">{{ __('Back') }}</a>
        </div>
    </div>
</div>

@endsection
