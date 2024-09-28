@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Chỉnh Sửa Bãi Biển</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Cảnh báo!</strong> Có một số vấn đề với dữ liệu bạn nhập.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('beaches.update', $beach->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên Bãi Biển</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $beach->name }}" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Quốc Gia</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ $beach->country }}">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Vị Trí</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $beach->location }}">
        </div>

        {{-- <div class="mb-3">
            <label for="area_id" class="form-label">Khu Vực</label>
            <select class="form-control" id="area_id" name="area_id">
                <option value="">Chọn Khu Vực</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ $beach->area_id == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $beach->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description2" class="form-label">Mô Tả 2</label>
            <textarea class="form-control" id="description2" name="description2" rows="3">{{ $beach->description2 }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description3" class="form-label">Mô Tả 3</label>
            <textarea class="form-control" id="description3" name="description3" rows="3">{{ $beach->description3 }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*">
            @if($beach->image_url)
                <img src="{{ asset($beach->image_url) }}" alt="Hình Ảnh Bãi Biển" class="img-thumbnail mt-2" width="200">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật Bãi Biển</button>
    </form>
</div>
@endsection
