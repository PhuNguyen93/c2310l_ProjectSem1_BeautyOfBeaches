@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $beach->name }}</h1>

    <div class="mb-3">
        <strong>Quốc Gia:</strong> {{ $beach->country }}
    </div>

    <div class="mb-3">
        <strong>Vị Trí:</strong> {{ $beach->location }}
    </div>

    <div class="mb-3">
        <strong>Khu Vực:</strong> {{ $beach->area ? $beach->area->name : 'Không xác định' }}
    </div>

    <div class="mb-3">
        <strong>Mô Tả:</strong>
        <p>{{ $beach->description }}</p>
        <p>{{ $beach->description2 }}</p>
        <p>{{ $beach->description3 }}</p>
    </div>

    @if($beach->image_url)
    <div class="mb-3">
        <img src="{{ asset($beach->image_url) }}" alt="Hình Ảnh Bãi Biển" class="img-fluid">
    </div>
@endif

    <a href="{{ route('beaches.edit', $beach->id) }}" class="btn btn-warning">Sửa</a>
    <form action="{{ route('beaches.destroy', $beach->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bãi biển này?')">Xóa</button>
    </form>
    <a href="{{ route('beaches.index') }}" class="btn btn-secondary">Quay Lại</a>
</div>
@endsection
