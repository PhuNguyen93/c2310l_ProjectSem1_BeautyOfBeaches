@extends('layouts.master')

@section('title')
    {{ __('Blogs List View') }}
@endsection

@section('content')
    <!-- page title -->
    <x-page-title title="Blog List View" pagetitle="Blog" />

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="xl:col-span-12">
            <div class="card" id="beachesTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Blogs List</h6>
                        <div class="shrink-0">

                            <button id="openModalButton"
                                class="px-4 py-2 text-white bg-custom-500 border border-custom-500 hover:bg-custom-600 hover:border-custom-600 rounded-lg flex items-center">
                                <i data-lucide="plus" class="inline-block size-4 mr-2"></i> <span class="align-middle">Add
                                    Blog</span>
                            </button>
                            {{-- modal --}}
                            <div id="addBlogModal" class="modal hidden">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add New Blog</h5>
                                        <button id="closeModalButton" class="close-button">&times;</button>
                                    </div>
                                    <form id="addBlogForm" action="{{ route('blogs.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" id="title" class="form-input"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea id="description" name="description" rows="3" class="form-input" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="images">Images</label>
                                                <input type="file" id="images" name="images[]" accept="image/*"
                                                    multiple onchange="previewImages(event)">
                                                <div id="imagePreview" class="image-preview-container"></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="px-4 py-2 text-white bg-custom-500 border border-custom-500 hover:bg-custom-600 hover:border-custom-600 rounded-lg flex items-center">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="!py-3.5 card-body border-y border-dashed border-slate-200 dark:border-zink-500">
                    <!-- Form tìm kiếm và bộ lọc -->
                    <form action="{{ route('admin.blog') }}" method="GET">
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                            <div class="relative xl:col-span-6">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Search for name, location, country..." autocomplete="off">
                                <i data-lucide="search"
                                    class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                            </div>

                            <div class="xl:col-span-3 xl:col-start-10">
                                <div class="flex gap-2 xl:justify-end">
                                    <button type="submit" class="btn bg-gray-500 text-white hover:bg-gray-600">Apply
                                        Filters</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="-mx-5 -mb-5 overflow-x-auto">
                        <table class="w-full border-separate table-custom border-spacing-y-1 whitespace-nowrap">
                            <thead class="text-left">
                                <tr class="relative rounded-md bg-slate-100 dark:bg-zink-600">
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold">Image</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="Title">
                                        Name
                                    </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="Content">
                                        Title</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="Content">
                                        Description</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort"
                                        data-sort="created_at">Creation Date</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold">Action</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td class="px-3.5 py-2.5">
                                            @if ($blog->image_url)
                                                <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}"
                                                    class="w-10 h-10 rounded-full img-thumbnail">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td class="px-3.5 py-2.5" data-sort="id">{{ $blog->user->name }}</td>
                                        <td class="px-3.5 py-2.5" data-sort="Title">{{ $blog->title }}</td>
                                        <td class="px-3.5 py-2.5" data-sort="Title">{{ Str::limit($blog->description, 30) }}</td>
                                        <td class="px-3.5 py-2.5" data-sort="created_at">
                                            {{ $blog->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td class="px-3.5 py-2.5 text-end">
                                            <div class="relative dropdown">
                                                <button
                                                    class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                                    id="beachesAction{{ $blog->id }}" data-bs-toggle="dropdown">
                                                    <i data-lucide="more-horizontal" class="size-3"></i>
                                                </button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                                    aria-labelledby="beachesAction{{ $blog->id }}">
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                            href="{{ route('beaches.show', $blog->id) }}">
                                                            <i data-lucide="eye"
                                                                class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                            <span class="align-middle">View</span>
                                                        </a>
                                                    </li>
                                                    {{-- <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                            href="{{ route('beaches.edit', $blog->id) }}">
                                                            <i data-lucide="file-edit"
                                                                class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                            <span class="align-middle">Edit</span>
                                                        </a>
                                                    </li> --}}
                                                    <li>
                                                        <form action="{{ route('blogs.destroy', $blog->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="block w-full text-left px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                                                <i data-lucide="trash-2"
                                                                    class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                                <span class="align-middle">Delete</span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col items-center mt-8 md:flex-row">
                        <div class="mb-4 grow md:mb-0">
                            <p class="text-slate-500 dark:text-zink-200">
                                Showing <b>{{ $blogs->count() }}</b> of <b>{{ $blogs->total() }}</b> Results
                            </p>
                        </div>
                        <ul class="flex flex-wrap items-center gap-2">
                            @if ($blogs->onFirstPage())
                                <li>
                                    <span
                                        class="disabled inline-flex items-center justify-center bg-gray-300 text-gray-500 border border-gray-200 rounded px-4 py-2">Previous</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $blogs->previousPageUrl() }}"
                                        class="inline-flex items-center justify-center bg-white text-slate-500 border border-slate-200 rounded px-4 py-2 hover:bg-custom-50">Previous</a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                                <li>
                                    <a href="{{ $blogs->url($i) }}"
                                        class="inline-flex items-center justify-center {{ $blogs->currentPage() == $i ? 'bg-custom-500 text-white' : 'bg-white text-slate-500 border border-slate-200' }} rounded px-4 py-2 hover:bg-custom-50">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor

                            @if ($blogs->hasMorePages())
                                <li>
                                    <a href="{{ $blogs->nextPageUrl() }}"
                                        class="inline-flex items-center justify-center bg-white text-slate-500 border border-slate-200 rounded px-4 py-2 hover:bg-custom-50">Next</a>
                                </li>
                            @else
                                <li>
                                    <span
                                        class="disabled inline-flex items-center justify-center bg-gray-300 text-gray-500 border border-gray-200 rounded px-4 py-2">Next</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headers = document.querySelectorAll('.sort');
            const tbody = document.querySelector('.list');

            let currentSort = null;
            let currentDirection = 'asc';

            headers.forEach(header => {
                header.addEventListener('click', () => {
                    const sortAttribute = header.getAttribute('data-sort');

                    // Nếu cột được sắp xếp đã được chọn, thì đảo chiều
                    if (currentSort === sortAttribute) {
                        currentDirection = (currentDirection === 'asc') ? 'desc' : 'asc';
                    } else {
                        currentSort = sortAttribute;
                        currentDirection = 'asc'; // Mặc định sắp xếp tăng dần khi chọn cột mới
                    }

                    // Sắp xếp dữ liệu
                    sortTable(tbody, currentSort, currentDirection);
                });
            });

            function sortTable(tbody, sortAttribute, direction) {
                const rows = Array.from(tbody.querySelectorAll('tr'));

                rows.sort((a, b) => {
                    const aText = a.querySelector(`[data-sort="${sortAttribute}"]`).textContent.trim();
                    const bText = b.querySelector(`[data-sort="${sortAttribute}"]`).textContent.trim();

                    if (direction === 'asc') {
                        return aText.localeCompare(bText);
                    } else {
                        return bText.localeCompare(aText);
                    }
                });

                // Xóa tất cả các hàng và thêm hàng đã sắp xếp
                tbody.innerHTML = '';
                rows.forEach(row => tbody.appendChild(row));
            }
        });

        // Hiển thị modal
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('addBlogModal').classList.remove('hidden');
        });

        // Đóng modal
        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('addBlogModal').classList.add('hidden');
        });

        // Xem trước hình ảnh
        function previewImages(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = '';
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(files[i]);
                img.classList.add('image-preview');
                imagePreview.appendChild(img);
            }
        }
    </script>
@endpush
<style>
    .image-preview-container {
        display: flex;
        flex-wrap: wrap;
        max-height: 300px;
        /* Giới hạn chiều cao của phần chứa ảnh */
        overflow-y: auto;
        /* Thanh cuộn khi có nhiều ảnh */
        gap: 10px;
        /* Khoảng cách giữa các ảnh */
    }

    .image-preview {
        width: 100px;
        /* Chiều rộng cố định của mỗi ảnh */
        height: 100px;
        /* Chiều cao cố định của mỗi ảnh */
        object-fit: cover;
        /* Giữ tỉ lệ của ảnh và cắt phần thừa */
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Modal Overlay */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .hidden {
        display: none;
    }

    /* Modal Content */
    .modal-content {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        width: 500px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.3s ease;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 1.5em;
        font-weight: bold;
    }

    .close-button {
        background: none;
        border: none;
        font-size: 1.5em;
        cursor: pointer;
    }

    .modal-body {
        margin-top: 10px;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .image-preview {
        margin-top: 10px;
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-submit {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .open-modal-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .open-modal-btn:hover {
        background-color: #0056b3;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>
