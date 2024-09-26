@extends('layouts.master')
@section('title')
    {{ __('Account Settings') }}
@endsection

@section('content')
    <!-- Custom CSS trực tiếp trong file -->
    <style>
        /* Tùy chỉnh profile image */
        .user-profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .user-profile-image:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* Tùy chỉnh table */
        .table {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background-color: #f1f3f5;
            transition: background-color 0.3s;
        }

        /* Card */
        .card {
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #f9f9f9;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        /* Badge */
        .badge {
            padding: 7px 12px;
            font-size: 0.9em;
            border-radius: 8px;
        }

        .badge.bg-success {
            background-color: #28a745;
            color: white;
        }

        .badge.bg-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge.bg-warning {
            background-color: #ffc107;
            color: black;
        }

        /* Profile Photo Edit */
        .profile-photo-edit {
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Social icons */
        .social-icon {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .social-icon:hover {
            background-color: #007bff;
            color: white;
            transform: translateY(-3px);
        }

        /* Button Hire Us */
        .btn.bg-custom-500 {
            background-color: #17a2b8;
            color: white;
            transition: background-color 0.3s ease, transform 0.3s ease;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .btn.bg-custom-500:hover {
            background-color: #138496;
            transform: translateY(-2px);
        }

        /* Dropdown Customization */
        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .dropdown-item {
            transition: background-color 0.3s ease, padding-left 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            padding-left: 20px;
        }
    </style>

    <!-- page title -->
    <x-page-title title="Account Settings" pagetitle="Pages" />

    <div class="card">
        <div class="card-body">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 2xl:grid-cols-12">
                <div class="lg:col-span-2 2xl:col-span-1">
                    <div
                        class="relative inline-block size-20 rounded-full shadow-md bg-slate-100 profile-user xl:size-28">
                        <img src="{{ URL::asset($user->img) }}" alt=""
                        class="object-cover border-0 rounded-full img-thumbnail user-profile-image">

                        <div
                            class="absolute bottom-0 flex items-center justify-center size-8 rounded-full ltr:right-0 rtl:left-0 profile-photo-edit">
                            <input id="profile-img-file-input" type="file" class="hidden profile-img-file-input">
                            <label for="profile-img-file-input"
                                class="flex items-center justify-center size-8 bg-white rounded-full shadow-lg cursor-pointer dark:bg-zink-600 profile-photo-edit">
                                <i data-lucide="image-plus"
                                    class="size-4 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                            </label>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="lg:col-span-10 2xl:col-span-9">
                    <h5 class="mb-1">{{ $user->name }} <i data-lucide="badge-check"
                            class="inline-block size-4 text-sky-500 fill-sky-100 dark:fill-custom-500/20"></i></h5>

                    <div class="flex gap-2 mt-4">
                        <a href="#!"
                            class="flex items-center justify-center transition-all duration-200 ease-linear rounded size-9 text-sky-500 bg-sky-100 hover:bg-sky-200 dark:bg-sky-500/20 dark:hover:bg-sky-500/30 social-icon">
                            <i data-lucide="facebook" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center text-pink-500 transition-all duration-200 ease-linear bg-pink-100 rounded size-9 hover:bg-pink-200 dark:bg-pink-500/20 dark:hover:bg-pink-500/30 social-icon">
                            <i data-lucide="instagram" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center text-red-500 transition-all duration-200 ease-linear bg-red-100 rounded size-9 hover:bg-red-200 dark:bg-red-500/20 dark:hover:bg-red-500/30 social-icon">
                            <i data-lucide="globe" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center transition-all duration-200 ease-linear rounded text-custom-500 bg-custom-100 size-9 hover:bg-custom-200 dark:bg-custom-500/20 dark:hover:bg-custom-500/30 social-icon">
                            <i data-lucide="linkedin" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center text-pink-500 transition-all duration-200 ease-linear bg-pink-100 rounded size-9 hover:bg-pink-200 dark:bg-pink-500/20 dark:hover:bg-pink-500/30 social-icon">
                            <i data-lucide="dribbble" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center transition-all duration-200 ease-linear rounded size-9 text-slate-500 bg-slate-100 hover:bg-slate-200 dark:bg-zink-600 dark:hover:bg-zink-500 social-icon">
                            <i data-lucide="github" class="size-4"></i>
                        </a>
                    </div>
                </div>
            </div><!--end grid-->
        </div>

    </div><!--end card-->

    <div class="card">
        <div class="card-body">
            <h5 class="my-3">Account Information</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->country }}</td>
                        <td>
                            <span class="badge @if($user->status === 'Verified') bg-success @elseif($user->status === 'Rejected') bg-danger @else bg-warning @endif">
                                {{ $user->status }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--end card-->
@endsection
