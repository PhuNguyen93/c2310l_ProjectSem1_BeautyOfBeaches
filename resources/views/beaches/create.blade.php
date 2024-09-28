@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Thêm Bãi Biển Mới</h1>

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

    <form action="{{ route('beaches.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Tên Bãi Biển</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên bãi biển" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Quốc Gia</label>
            <input type="text" class="form-control" id="country" name="country" placeholder="Nhập quốc gia">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Vị Trí</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Nhập vị trí">
        </div>

        {{-- <div class="mb-3">
            <label for="area_id" class="form-label">Khu Vực</label>
            <select class="form-control" id="area_id" name="area_id">
                <option value="">Chọn Khu Vực</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả"></textarea>
        </div>

        <div class="mb-3">
            <label for="description2" class="form-label">Mô Tả 2</label>
            <textarea class="form-control" id="description2" name="description2" rows="3" placeholder="Nhập mô tả bổ sung"></textarea>
        </div>

        <div class="mb-3">
            <label for="description3" class="form-label">Mô Tả 3</label>
            <textarea class="form-control" id="description3" name="description3" rows="3" placeholder="Nhập mô tả bổ sung"></textarea>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" id="image_url" name="image_url" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Thêm Bãi Biển</button>
    </form>
</div>
@endsection
