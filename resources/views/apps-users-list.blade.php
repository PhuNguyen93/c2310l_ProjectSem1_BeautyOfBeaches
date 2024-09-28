@extends('layouts.master')
@section('title')
    {{ __('List View') }}
@endsection
@section('content')
    <!-- page title -->
    <x-page-title title="List View" pagetitle="Users" />

    <div class="grid grid-cols-1 gap-x-5 xl:grid-cols-12">
        <div class="xl:col-span-12">
            <div class="card" id="usersTable">
                <div class="card-body">
                    <div class="flex items-center">
                        <h6 class="text-15 grow">Users List</h6>

                        <div class="shrink-0">
                            <button data-modal-target="addUserModal" type="button"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i
                                    data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add
                                    User</span></button>
                        </div>

                    </div>
                </div>
                <div class="!py-3.5 card-body border-y border-dashed border-slate-200 dark:border-zink-500">
                                    <!-- Kiểm tra và hiển thị thông báo lỗi -->
                @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                    <form action="{{ route('users.index') }}" method="GET">
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                            <div class="relative xl:col-span-2">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Search for name, email, phone number etc..." autocomplete="off">
                                <i data-lucide="search"
                                    class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                            </div><!--end col-->
                            <div class="xl:col-span-2">
                                <select name="status"
                                    class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    data-choices id="choices-single-default">
                                    <option value="">Select Status</option>
                                    <option value="Verified" {{ request('status') == 'Verified' ? 'selected' : '' }}>Verified</option>
                                    <option value="Waiting" {{ request('status') == 'Waiting' ? 'selected' : '' }}>Waiting</option>
                                    <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    {{-- <option value="Hidden" {{ request('status') == 'Hidden' ? 'selected' : '' }}>Hidden</option> --}}
                                </select>
                            </div><!--end col-->
                            <div class="xl:col-span-3 xl:col-start-10">
                                <div class="flex gap-2 xl:justify-end">
                                    <button type="submit" class="btn bg-custom-500 text-white">Apply Filters</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end grid-->
                    </form>

                </div>

                <div class="card-body">
                    <div class="-mx-5 -mb-5 overflow-x-auto">
                        <table class="w-full border-separate table-custom border-spacing-y-1 whitespace-nowrap">
                            <thead class="text-left">
                                <tr class="relative rounded-md bg-slate-100 dark:bg-zink-600 after:absolute ltr:after:border-l-2 rtl:after:border-r-2 ltr:after:left-0 rtl:after:right-0 after:top-0 after:bottom-0 after:border-transparent [&.active]:after:border-custom-500 [&.active]:bg-slate-100 dark:[&.active]:bg-zink-600">
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold">
                                    </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold">Avatar</th>
                                    {{-- <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="user-id">User ID</th> --}}
                                    {{-- <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="user-img">img</th> --}}
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="name">Name</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="email">Email</th>
                                    {{-- <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="role-id">Role ID</th> --}}
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="phone">phone</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort" data-sort="joining-date">Joining Date</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold sort " data-sort="status">Action</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach($users as $user)
                                <tr>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5">
                                        <div class="flex items-center h-full">
                                            <input id="Checkbox{{ $user->id }}"
                                                class="bg-white border border-black rounded-sm appearance-none cursor-pointer"
                                                type="checkbox">
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <img src="{{ asset($user->img) }}" alt="Avatar" class="w-10 h-10 rounded-full"> <!-- Hiển thị avatar -->
                                    </td>
                                    {{-- <td class="px-3.5 py-2.5">{{ $user->id }}</td> --}}
                                    {{-- <td class="px-3.5 py-2.5">{{ $user->img }}</td> --}}
                                    <td class="px-3.5 py-2.5"  data-sort="name">{{ $user->name }}</td>
                                    <td class="px-3.5 py-2.5" data-sort="email">{{ $user->email }}</td>
                                    {{-- <td class="px-3.5 py-2.5">{{ $user->role_id }}</td> --}}
                                    <td class="px-3.5 py-2.5" data-sort="phone">{{ $user->phone }}</td>
                                    <td class="px-3.5 py-2.5" data-sort="joining-date">{{ $user->created_at }}</td>
                                    {{-- <td class="px-3.5 py-2.5" data-sort="status">
                                        @if ($user->status === 'Rejected')
                                            <span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent status">
                                                <i data-lucide="x" class="size-3 mr-1.5"></i> Rejected
                                            </span>
                                        @elseif ($user->status === 'Waiting')
                                            <span class="px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded border bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:text-zink-200 dark:border-transparent status">
                                                <i data-lucide="loader" class="size-3 mr-1.5"></i> Waiting
                                            </span>
                                        @elseif ($user->status === 'Verified')
                                            <span class="px-2.5 py-0.5 text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent inline-flex items-center status">
                                                <i data-lucide="check-circle" class="size-3 mr-1.5"></i> Verified
                                            </span>
                                        @endif
                                    </td> --}}


                                    <td class="px-3.5 py-2.5">
                                        <div class="relative dropdown">
                                            <button class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                                id="usersAction{{ $user->id }}" data-bs-toggle="dropdown">
                                                <i data-lucide="more-horizontal" class="size-3"></i>
                                            </button>
                                            <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                                aria-labelledby="usersAction{{ $user->id }}">
                                                <li>
                                                    <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="{{ route('account.show', $user->id) }}">
                                                     <i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                     <span class="align-middle">Overview</span>
                                                 </a>
                                                </li>
                                                <li>
                                                    <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                       href="{{ route('account-settings', $user->id) }}">
                                                        <i data-lucide="file-edit" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                        <span class="align-middle">Edit</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="block w-full text-left px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                                            <i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
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
                            <p class="text-slate-500 dark:text-zink-200">Showing <b>{{ $users->count() }}</b> of <b>{{ $users->total() }}</b> Results</p>
                        </div>
                        <ul class="flex flex-wrap items-center gap-2">
                            @if ($users->onFirstPage())
                                <li><span class="disabled inline-flex items-center justify-center bg-gray-300 text-gray-500 border border-gray-200 rounded px-4 py-2">Previous</span></li>
                            @else
                                <li><a href="{{ $users->previousPageUrl() }}" class="inline-flex items-center justify-center bg-white text-slate-500 border border-slate-200 rounded px-4 py-2 hover:bg-custom-50">Previous</a></li>
                            @endif

                            @for ($i = 1; $i <= $users->lastPage(); $i++)
                                <li>
                                    <a href="{{ $users->url($i) }}" class="inline-flex items-center justify-center {{ ($users->currentPage() == $i) ? 'bg-custom-500 text-white' : 'bg-white text-slate-500 border border-slate-200' }} rounded px-4 py-2 hover:bg-custom-50">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor

                            @if ($users->hasMorePages())
                                <li><a href="{{ $users->nextPageUrl() }}" class="inline-flex items-center justify-center bg-white text-slate-500 border border-slate-200 rounded px-4 py-2 hover:bg-custom-50">Next</a></li>
                            @else
                                <li><span class="disabled inline-flex items-center justify-center bg-gray-300 text-gray-500 border border-gray-200 rounded px-4 py-2">Next</span></li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end grid-->

       <div id="addUserModal" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">

    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600">

        <div class="flex items-center justify-between p-4 border-b dark:border-zink-300/20">
            <h5 class="text-16">Add User</h5>
            <button data-modal-close="addUserModal"
                class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>

        <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">

            <!-- Form để thêm người dùng -->
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="userNameInput" class="inline-block mb-2 text-base font-medium">Name</label>
                    <input type="text" id="userNameInput" name="name"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                        placeholder="Enter name" value="{{ old('name') }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="emailInput" class="inline-block mb-2 text-base font-medium">Email</label>
                    <input type="email" id="emailInput" name="email"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                        placeholder="Enter email" value="{{ old('email') }}" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="passwordInput" class="inline-block mb-2 text-base font-medium">Password</label>
                    <input type="password" id="passwordInput" name="password"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                        placeholder="Enter password" required>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="role_id" class="inline-block mb-2 text-base font-medium">Role</label>
                    <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500" name="role_id" id="role_id">
                        <option value="1" {{ old('role_id') == 2 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ old('role_id') == 1 ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="statusSelect" class="inline-block mb-2 text-base font-medium">Status</label>
                    <select class="form-input border-slate-300 focus:outline-none focus:border-custom-500" name="status" id="statusSelect">
                        <option value="Verified" {{ old('status') == 'Verified' ? 'selected' : '' }}>Verified</option>
                        <option value="Waiting" {{ old('status') == 'Waiting' ? 'selected' : '' }}>Waiting</option>
                        <option value="Rejected" {{ old('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="reset" data-modal-close="addUserModal"
                        class="text-red-500 transition-all duration-200 ease-linear bg-white border-white btn hover:text-red-600">Cancel</button>
                    <button type="submit"
                        class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end add user-->

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert"
        style="background-color: #28a745; color: white; font-size: 18px; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0,0,0,0.1);">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert"
        style="background-color: #dc3545; color: white; font-size: 18px; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0,0,0,0.1);">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@endsection

@push('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        // Đợi cho DOM sẵn sàng
        document.addEventListener('DOMContentLoaded', function() {
            // Tìm tất cả các alert có class 'alert-dismissible'
            var alerts = document.querySelectorAll('.alert-dismissible');

            // Đặt thời gian để tự động đóng các alert sau 3 giây (3000ms)
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    alert.addEventListener('transitionend', function() {
                        alert.style.display = 'none';
                    });
                }, 3000); // 3000ms = 3 giây
            });
        });
        </script>
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
