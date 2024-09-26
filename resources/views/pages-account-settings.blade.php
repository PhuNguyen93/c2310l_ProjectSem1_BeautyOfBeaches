@extends('layouts.master')
@section('title')
    {{ __('Account Settings') }}
@endsection
@section('content')
    <!-- page title -->
    <x-page-title title="Account Settings" pagetitle="Pages" />

    <div class="card">
        <div class="card-body">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 2xl:grid-cols-12">
                <div class="lg:col-span-2 2xl:col-span-1">
                    <div
                        class="relative inline-block size-20 rounded-full shadow-md bg-slate-100 profile-user xl:size-28">
                        <img src="{{ URL::asset('build/images/users/avatar-1.png') }}" alt=""
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
                    <h5 class="mb-1">Paula Keenan <i data-lucide="badge-check"
                            class="inline-block size-4 text-sky-500 fill-sky-100 dark:fill-custom-500/20"></i></h5>

                    <div class="flex gap-2 mt-4">
                        <a href="#!"
                            class="flex items-center justify-center transition-all duration-200 ease-linear rounded size-9 text-sky-500 bg-sky-100 hover:bg-sky-200 dark:bg-sky-500/20 dark:hover:bg-sky-500/30">
                            <i data-lucide="facebook" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center text-pink-500 transition-all duration-200 ease-linear bg-pink-100 rounded size-9 hover:bg-pink-200 dark:bg-pink-500/20 dark:hover:bg-pink-500/30">
                            <i data-lucide="instagram" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center text-red-500 transition-all duration-200 ease-linear bg-red-100 rounded size-9 hover:bg-red-200 dark:bg-red-500/20 dark:hover:bg-red-500/30">
                            <i data-lucide="globe" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center transition-all duration-200 ease-linear rounded text-custom-500 bg-custom-100 size-9 hover:bg-custom-200 dark:bg-custom-500/20 dark:hover:bg-custom-500/30">
                            <i data-lucide="linkedin" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center text-pink-500 transition-all duration-200 ease-linear bg-pink-100 rounded size-9 hover:bg-pink-200 dark:bg-pink-500/20 dark:hover:bg-pink-500/30">
                            <i data-lucide="dribbble" class="size-4"></i>
                        </a>
                        <a href="#!"
                            class="flex items-center justify-center transition-all duration-200 ease-linear rounded size-9 text-slate-500 bg-slate-100 hover:bg-slate-200 dark:bg-zink-600 dark:hover:bg-zink-500">
                            <i data-lucide="github" class="size-4"></i>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-12 2xl:col-span-2">
                    <div class="flex gap-2 2xl:justify-end">
                        <a href="mailto:themesdesign@gmail.com"
                            class="flex items-center justify-center size-[37.5px] p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"><i
                                data-lucide="mail" class="size-4"></i></a>
                        <button type="button"
                            class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Hire
                            Us</button>

                        <div class="relative dropdown">
                            <button
                                class="flex items-center justify-center size-[37.5px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                id="accountSettings" data-bs-toggle="dropdown"><i data-lucide="more-horizontal"
                                    class="size-4"></i></button>
                            <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white dark:bg-zink-600 rounded-md shadow-md dropdown-menu min-w-[10rem]"
                                aria-labelledby="accountSettings">
                                <li class="px-3 mb-2 text-sm text-slate-500">
                                    Payments
                                </li>
                                <li>
                                    <a class="block px-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                        href="#!">Create Invoice</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                        href="#!">Pending Billing</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                        href="#!">Generate Bill</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-1.5 text-base font-medium transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                        href="#!">Subscription</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!--end grid-->
        </div>
        <div class="card-body !py-0">
            <ul class="flex flex-wrap w-full text-sm font-medium text-center nav-tabs">
                <li class="group active">
                    <a href="javascript:void(0);" data-tab-toggle data-target="personalTabs"
                        class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">Personal
                        Info</a>
                </li>

                <li class="group">
                    <a href="javascript:void(0);" data-tab-toggle data-target="changePasswordTabs"
                        class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">Change
                        Password</a>
                </li>

            </ul>
        </div>
    </div><!--end card-->

    <div class="tab-content">
        <div class="block tab-pane" id="personalTabs">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-1 text-15">Personal Information</h6>
                    <p class="mb-4 text-slate-500 dark:text-zink-200">Update your photo and personal details here easily.
                    </p>
                    <form action="{{ route('users.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                            <!-- First Name -->
                            <div class="xl:col-span-6">
                                <label for="name" class="inline-block mb-2 text-base font-medium text-gray-700 dark:text-zinc-200">First Name</label>
                                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100"
                                    required placeholder="Enter your first name">
                            </div>

                            <!-- Phone Number -->
                            <div class="xl:col-span-6">
                                <label for="phone" class="inline-block mb-2 text-base font-medium text-gray-700 dark:text-zinc-200">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ Auth::user()->phone }}"
                                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100"
                                    placeholder="Enter your phone number">
                            </div>

                            <!-- Email Address -->
                            <div class="xl:col-span-6">
                                <label for="email" class="inline-block mb-2 text-base font-medium text-gray-700 dark:text-zinc-200">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100"
                                    required placeholder="Enter your email address">
                            </div>

                            <!-- Birth Date -->
                            <div class="xl:col-span-6">
                                <label for="birth_date" class="inline-block mb-2 text-base font-medium text-gray-700 dark:text-zinc-200">Birth Date</label>
                                <input type="date" name="birth_date" id="birth_date" value="{{ Auth::user()->birth_date }}"
                                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
                            </div>

                            <!-- Country -->
                            <div class="xl:col-span-4">
                                <label for="country" class="inline-block mb-2 text-base font-medium text-gray-700 dark:text-zinc-200">Country</label>
                                <input type="text" name="country" id="country" value="{{ Auth::user()->country }}"
                                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100"
                                    placeholder="Enter your country">
                            </div>

                            <!-- Profile Image -->
                            <div class="xl:col-span-12">
                                <label for="img" class="block mb-2 text-base font-medium text-gray-700 dark:text-zinc-200">Profile Image</label>
                                <input type="file" name="img" id="img" accept="image/*"
                                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-200 ease-in-out dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-100">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end mt-6 gap-x-4">
                            <button type="submit" class="px-6 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 transition duration-200 ease-in-out">Update</button>
                            <button type="button" class="px-6 py-2 text-red-500 bg-red-100 rounded-lg hover:bg-red-500 hover:text-white focus:ring-2 focus:ring-red-500 transition duration-200 ease-in-out">Cancel</button>
                        </div>
                    </form>

                    <!--end form-->
                </div>
            </div>
        </div>

        <div class="hidden tab-pane" id="changePasswordTabs">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-4 text-15">Change Password</h6>
                    <form action="{{ route('users.changePassword') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-5 xl:grid-cols-12">
                            <div class="xl:col-span-4">
                                <label for="old_password" class="inline-block mb-2 text-base font-medium">Old Password*</label>
                                <div class="relative">
                                    <input type="password" name="old_password" id="old_password"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                        placeholder="Enter current password" required>
                                    <button class="absolute top-2 ltr:right-4 rtl:left-4 " type="button">
                                        <i class="align-middle ri-eye-fill text-slate-500 dark:text-zink-200"></i>
                                    </button>
                                </div>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="new_password" class="inline-block mb-2 text-base font-medium">New Password*</label>
                                <div class="relative">
                                    <input type="password" name="new_password" id="new_password"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                        placeholder="Enter new password" required>
                                    <button class="absolute top-2 ltr:right-4 rtl:left-4 " type="button">
                                        <i class="align-middle ri-eye-fill text-slate-500 dark:text-zink-200"></i>
                                    </button>
                                </div>
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <label for="confirm_password" class="inline-block mb-2 text-base font-medium">Confirm Password*</label>
                                <div class="relative">
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                        placeholder="Confirm password" required>
                                    <button class="absolute top-2 ltr:right-4 rtl:left-4 " type="button">
                                        <i class="align-middle ri-eye-fill text-slate-500 dark:text-zink-200"></i>
                                    </button>
                                </div>
                            </div><!--end col-->
                            <div class="flex justify-end xl:col-span-6">
                                <button type="submit"
                                    class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600">Change Password</button>
                            </div>
                        </div><!--end grid-->
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
@push('scripts')
    <script src="{{ URL::asset('build/js/pages/pages-account-setting.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endpush
