@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Danh Sách Bãi Biển</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('beaches.create') }}" class="btn btn-primary mb-3">Thêm Bãi Biển Mới</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Hình Ảnh</th> <!-- Cột mới để hiển thị hình ảnh -->
                <th>Tên Bãi Biển</th>
                <th>Quốc Gia</th>
                <th>Vị Trí</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beaches as $beach)
                <tr>
                    <td>
                        @if($beach->image_url)
                            <img src="{{ asset($beach->image_url) }}" alt="{{ $beach->name }}" width="100" class="img-thumbnail">
                        @else
                            <span>Không có hình ảnh</span>
                        @endif
                    </td>
                    <td>{{ $beach->name }}</td>
                    <td>{{ $beach->country }}</td>
                    <td>{{ $beach->location }}</td>
                    <td>
                        <a href="{{ route('beaches.show', $beach->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('beaches.edit', $beach->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('beaches.destroy', $beach->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa bãi biển này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
