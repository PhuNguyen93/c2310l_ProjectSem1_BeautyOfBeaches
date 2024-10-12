@extends('layouts.master')

@section('title')
    {{ __('Beaches Bin ') }}
@endsection

@section('content')
    <!-- page title -->
    <x-page-title title="Beach" pagetitle="Beach" />

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="xl:col-span-12">
            <div class="card" id="beachesTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Beaches Listsadsadsadasd</h6>

                        <div class="shrink-0">
                            <a href="{{ route('beaches.create') }}"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                <i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add
                                    Beach</span>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="!py-3.5 card-body border-y border-dashed border-slate-200 dark:border-zink-500">
                    <!-- Form tìm kiếm và bộ lọc -->
                    <form action="{{ route('beaches.index') }}" method="GET">
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

                <!-- Bảng danh sách bãi biển -->
                <div class="card-body">
                    <div class="-mx-5 -mb-5 overflow-x-auto">
                        <table class="w-full border-separate table-custom border-spacing-y-1 whitespace-nowrap">
                            <thead class="text-left">
                                <tr class="relative rounded-md bg-slate-100 dark:bg-zink-600">
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold">Avatar</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="name">Name
                                    </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="country">
                                        Country</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="location">
                                        Location</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort"
                                        data-sort="created_at">Creation Date</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold text-end">Action</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach ($beaches as $beach)
                                    <tr>
                                        <td class="px-3.5 py-2.5">
                                            @if ($beach->image_url)
                                                <img src="{{ asset($beach->image_url) }}" alt="{{ $beach->name }}"
                                                    class="w-10 h-10 rounded-full img-thumbnail">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td class="px-3.5 py-2.5" data-sort="name">{{ $beach->name }}</td>
                                        <td class="px-3.5 py-2.5" data-sort="country">{{ $beach->country }}</td>
                                        <td class="px-3.5 py-2.5" data-sort="location">{{ $beach->location }}</td>
                                        <td class="px-3.5 py-2.5" data-sort="created_at">
                                            {{ $beach->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td class="px-3.5 py-2.5 text-end">
                                            <div class="relative dropdown">
                                                <button
                                                    class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                                    id="beachesAction{{ $beach->id }}" data-bs-toggle="dropdown">
                                                    <i data-lucide="more-horizontal" class="size-3"></i>
                                                </button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                                    aria-labelledby="beachesAction{{ $beach->id }}">
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                            href="{{ route('beaches.show', $beach->id) }}">
                                                            <i data-lucide="eye"
                                                                class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                            <span class="align-middle">View</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                            href="{{ route('beaches.edit', $beach->id) }}">
                                                            <i data-lucide="file-edit"
                                                                class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                            <span class="align-middle">Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('beaches.restore', $beach->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirmRestore();">
                                                            @csrf
                                                            <button type="submit"
                                                                class="block w-full text-left px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                                                <i data-lucide="trash-2"
                                                                    class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                                <span class="align-middle">Restore</span>




                                                            </button>

                                                        </form>
                                                        @if (session('success'))
                                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                        <script>
                                                            Swal.fire({
                                                                title: 'Success',
                                                                text: '{{ session('success') }}',
                                                                icon: 'success',
                                                                confirmButtonText: 'OK'
                                                            }).then(() => {
                                                                @if (session('otp_sent'))
                                                                    Alpine.store('step', 'verify');
                                                                @elseif (session('otp_verified'))
                                                                    Alpine.store('step', 'reset');
                                                                @endif
                                                            });
                                                        </script>
                                                    @endif

                                                    <!-- SweetAlert thông báo lỗi -->
                                                    @if (session('error'))
                                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                        <script>
                                                            Swal.fire({
                                                                title: 'Error',
                                                                text: '{{ session('error') }}',
                                                                icon: 'error',
                                                                confirmButtonText: 'OK'
                                                            });
                                                        </script>
                                                    @endif

                                                    </li>
                                                    <li>
                                                        <form action="{{ route('beaches.destroybin', $beach->id) }}"
                                                            {{-- <form action="" --}} method="POST" style="display:inline;"
                                                            onsubmit="return confirmDelete();">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="block w-full text-left px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                                                <i data-lucide="trash-2"
                                                                    class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                                <span class="align-middle">Delete</span>
                                                            </button>
                                                            <script>
                                                                function confirmDelete() {
                                                                    return confirm('Are you sure you want to delete this beach? This action cannot be undone.');
                                                                }
                                                            </script>
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
                            <p class="text-slate-500 dark:text-zink-200">Showing <b>{{ $beaches->count() }}</b> of
                                <b>{{ $beaches->total() }}</b> Results
                            </p>
                        </div>
                        <ul class="flex flex-wrap items-center gap-2">
                            @if ($beaches->onFirstPage())
                                <li><span
                                        class="disabled inline-flex items-center justify-center bg-gray-300 text-gray-500 border border-gray-200 rounded px-4 py-2">Previous</span>
                                </li>
                            @else
                                <li><a href="{{ $beaches->previousPageUrl() }}"
                                        class="inline-flex items-center justify-center bg-white text-slate-500 border border-slate-200 rounded px-4 py-2 hover:bg-custom-50">Previous</a>
                                </li>
                            @endif

                            @for ($i = 1; $i <= $beaches->lastPage(); $i++)
                                <li>
                                    <a href="{{ $beaches->url($i) }}"
                                        class="inline-flex items-center justify-center {{ $beaches->currentPage() == $i ? 'bg-custom-500 text-white' : 'bg-white text-slate-500 border border-slate-200' }} rounded px-4 py-2 hover:bg-custom-50">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor

                            @if ($beaches->hasMorePages())
                                <li><a href="{{ $beaches->nextPageUrl() }}"
                                        class="inline-flex items-center justify-center bg-white text-slate-500 border border-slate-200 rounded px-4 py-2 hover:bg-custom-50">Next</a>
                                </li>
                            @else
                                <li><span
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
    </script>
@endpush
