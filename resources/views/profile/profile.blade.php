<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <style>
        body {
            margin-top: 20px;
            background-color: #e2e8f0;
            color: #1a202c;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            background-color: #fff;
            border-radius: .25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .1), 0 1px 2px rgba(0, 0, 0, .06);
        }

        .card-body {
            padding: 1rem;
        }

        .gutters-sm {
            margin: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding: 8px;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="main-body">
            <!-- Breadcrumb -->

            <!-- Profile Section -->
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">

                        <div class="card-body text-center">
                            <form action="{{ route('profile.upload_avatar') }}" method="POST"
                                enctype="multipart/form-data" id="UpdateAvatar">
                                @csrf
                                <div
                                    class="relative inline-block size-20 rounded-full shadow-md bg-slate-100 profile-user xl:size-28">
                                    <!-- Nhấp vào hình ảnh để chọn tệp -->
                                    <label for="profile-img-file-input" style="cursor: pointer;">
                                        <img src="{{ asset($user->img) }}" alt="Avatar" class="media-object"
                                            style="width: 200px; height: 200px; border: 2px solid #d1d5db; border-radius: 50%;">
                                        <input id="profile-img-file-input" type="file" name="avatar" class="hidden"
                                            accept="image/*" required>
                                    </label>
                                </div>
                            </form>

                            <h2 class="media-heading" style="color: #333;">{{ $user->name }}</h2>

                            <style>
                                #profile-img-file-input {
                                    display: none;
                                    /* Ẩn input file */
                                }
                            </style>

                            <script>
                                document.getElementById('profile-img-file-input').addEventListener('change', function() {
                                    if (this.files.length > 0) {
                                        document.getElementById('UpdateAvatar').submit(); // Gửi form khi người dùng chọn tệp
                                    }
                                });
                            </script>

                            <!-- Nút Home -->
                            <div class="mt-3">
                                <a href="http://127.0.0.1:8000"> <!-- Thay đổi đường dẫn đến trang home của bạn -->
                                    <img src="http://127.0.0.1:8000/assets/images/logo.png" alt="Logo"
                                        width="64" height="64" style="object-fit: contain;">
                                </a>
                            </div>

                        </div>



                    </div>

                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-globe mr-2 icon-inline">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                        </path>
                                    </svg>Website</h6>
                                <span class="text-secondary">https://bootdey.com</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-github mr-2 icon-inline">
                                        <path
                                            d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                        </path>
                                    </svg>Github</h6>
                                <span class="text-secondary">bootdey</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-twitter mr-2 icon-inline text-info">
                                        <path
                                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                        </path>
                                    </svg>Twitter</h6>
                                <span class="text-secondary">@bootdey</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-instagram mr-2 icon-inline text-danger">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                        </rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>Instagram</h6>
                                <span class="text-secondary">bootdey</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-facebook mr-2 icon-inline text-primary">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                        </path>
                                    </svg>Facebook</h6>
                                <span class="text-secondary">bootdey</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Info Section -->
                <div class="col-md-8">

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row mb-3 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0 fw-bold text-muted">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <i class="bi bi-person-fill"></i> {{ $user->name }}
                                </div>
                            </div>
                            <div class="border-bottom mb-3"></div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0 fw-bold text-muted">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <i class="bi bi-envelope-fill"></i> {{ $user->email }}
                                </div>
                            </div>
                            <div class="border-bottom mb-3"></div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0 fw-bold text-muted">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <i class="bi bi-telephone-fill"></i> {{ $user->phone }}
                                </div>
                            </div>
                            <div class="border-bottom mb-3"></div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0 fw-bold text-muted">Country</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <i class="bi bi-globe"></i> {{ $user->country ?? 'Not provided' }}
                                </div>
                            </div>
                            <div class="border-bottom mb-3"></div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0 fw-bold text-muted">Birthday</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <i class="bi bi-calendar-fill"></i> {{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') : 'Not provided' }}
                                </div>
                            </div>
                            <div class="border-bottom mb-3"></div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-sm-3">
                                    <h6 class="mb-0 fw-bold text-muted">Joining Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <i class="bi bi-clock-fill"></i> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>


                        <div class="row gutters-sm">
                            <div class="tab-block">
                                <ul class="nav nav-tabs justify-content-center flex-wrap"
                                    style="margin: 20px; padding: 0;">

                                    <!-- Hàng đầu tiên: 3 nút đầu tiên -->
                                    <li class="group mx-2">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="updateProfileTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zinc-200 border border-transparent hover:text-white hover:bg-custom-500 dark:hover:bg-custom-500 active:bg-custom-600 dark:active:bg-custom-600 active:text-white shadow-sm"
                                            style="text-decoration: none;">
                                            Update Profile
                                        </a>
                                    </li>
                                    <li class="group mx-2">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="changePasswordTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zinc-200 border border-transparent hover:text-white hover:bg-custom-500 dark:hover:bg-custom-500 active:bg-custom-600 dark:active:bg-custom-600 active:text-white shadow-sm"
                                            style="text-decoration: none;">
                                            Change Password
                                        </a>
                                    </li>
                                    <li class="group mx-2">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="privacyPolicyTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zinc-200 border border-transparent hover:text-white hover:bg-custom-500 dark:hover:bg-custom-500 active:bg-custom-600 dark:active:bg-custom-600 active:text-white shadow-sm"
                                            style="text-decoration: none;">
                                            Privacy Policy
                                        </a>
                                    </li>

                                    <!-- Hàng thứ hai: 3 nút còn lại -->
                                    <li class="group mx-2 mt-2">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="userBlogsTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zinc-200 border border-transparent hover:text-white hover:bg-custom-500 dark:hover:bg-custom-500 active:bg-custom-600 dark:active:bg-custom-600 active:text-white shadow-sm"
                                            style="text-decoration: none;">
                                            Blogs
                                        </a>
                                    </li>
                                    <li class="group mx-2 mt-2">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="userFeedbackBlogsTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zinc-200 border border-transparent hover:text-white hover:bg-custom-500 dark:hover:bg-custom-500 active:bg-custom-600 dark:active:bg-custom-600 active:text-white shadow-sm"
                                            style="text-decoration: none;">
                                            Feedbacks Blogs
                                        </a>
                                    </li>
                                    <li class="group mx-2 mt-2">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="userFeedbackTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zinc-200 border border-transparent hover:text-white hover:bg-custom-500 dark:hover:bg-custom-500 active:bg-custom-600 dark:active:bg-custom-600 active:text-white shadow-sm"
                                            style="text-decoration: none;">
                                            Feedbacks Beaches
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>

                    <div id="updateProfileTab" class="tab-content" style="display: none;">

                        <div class="card"
                            style="  background-color: white;
                            font-family: Arial, sans-serif; color: #333;">
                            <div class="card-body">
                                <form action="{{ route('profile.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <h3 style="font-weight: bold; margin-top: 0px;color: #4A4A4A;">
                                        Personal Information</h3>

                                    <div class="grid"
                                        style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                                        <div>
                                            <label for="firstName" class="block mb-2 text-base font-medium"
                                                style="color: #333;">Name</label>
                                            <input type="text" id="firstName" name="name"
                                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(80, 19, 178, 0.1);"
                                                placeholder="Enter your value" value="{{ old('name', $user->name) }}"
                                                required>
                                        </div>

                                        <div>
                                            <label for="phoneNumber" class="block mb-2 text-base font-medium"
                                                style="color: #333;">Phone Number</label>
                                            <input type="text" id="phoneNumber" name="phone"
                                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                                placeholder="" value="{{ old('phone', $user->phone) }}">
                                        </div>

                                        <div>
                                            <label for="emailInput" class="block mb-2 text-base font-medium"
                                                style="color: #333;">Email Address</label>
                                            <input type="email" id="emailInput" name="email"
                                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                                placeholder="Enter your email address"
                                                value="{{ old('email', $user->email) }}" disabled>
                                        </div>

                                        <div>
                                            <label for="birthDateInput" class="block mb-2 text-base font-medium"
                                                style="color: #333;">Birth Date</label>
                                            <input type="date" id="birthDateInput" name="birth_date"
                                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                                value="{{ old('birth_date', $user->birth_date) }}">
                                        </div>

                                        <div>
                                            <label for="countryInput" class="block mb-2 text-base font-medium"
                                                style="color: #333;">Country</label>
                                            <input type="text" id="countryInput" name="country"
                                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                                placeholder="Enter your value"
                                                value="{{ old('country', $user->country) }}">
                                        </div>

                                        <div>
                                            <label for="joiningDateInput" class="block mb-2 text-base font-medium"
                                                style="color: #333;">Joining Date</label>
                                            <input type="text" id="joiningDateInput" name="joining_date"
                                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                                value="{{ $user->created_at }}" disabled>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="flex justify-end mt-6 gap-x-4">
                                        <button type="submit"
                                            style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 0.375rem; cursor: pointer; transition: background-color 0.2s; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                                            Update
                                        </button>
                                        {{-- <button type="submit"
                                        style="padding: 10px 20px; background-color: rgb(224, 65, 56); color: white; border: none; border-radius: 0.375rem; cursor: pointer; transition: background-color 0.2s; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                                        Cancel
                                    </button> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="changePasswordTab" class="tab-content" style="display: none;">

                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('change.password', ['id' => $user->id]) }}" method="POST"
                                    style=" background-color: white; font-family: Arial, sans-serif; color: #333;">
                                    @csrf <!-- Bảo vệ chống tấn công CSRF -->

                                    <div style="display: flex; justify-content: space-between; gap: 1rem;">
                                        <div class="form-group" style="flex: 1;">
                                            <label for="oldpasswordInput"
                                                class="inline-block mb-2 text-base font-medium">Old
                                                Password*</label>
                                            <div class="relative">
                                                <input type="password" name="old_password" id="oldpasswordInput"
                                                    placeholder="Enter current password"
                                                    style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; transition: border-color 0.2s;"
                                                    onfocus="this.style.borderColor='#4ade80';"
                                                    onblur="this.style.borderColor='#d1d5db';">
                                            </div>
                                        </div>

                                        <div class="form-group" style="flex: 1;">
                                            <label for="newpasswordInput"
                                                class="inline-block mb-2 text-base font-medium">New
                                                Password*</label>
                                            <div class="relative">
                                                <input type="password" name="new_password" id="newpasswordInput"
                                                    placeholder="Enter new password"
                                                    style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; transition: border-color 0.2s;"
                                                    onfocus="this.style.borderColor='#4ade80';"
                                                    onblur="this.style.borderColor='#d1d5db';">
                                            </div>
                                        </div>

                                        <div class="form-group" style="flex: 1;">
                                            <label for="confirmPasswordInput"
                                                class="inline-block mb-2 text-base font-medium">Confirm
                                                Password*</label>
                                            <div class="relative">
                                                <input type="password" name="new_password_confirmation"
                                                    id="confirmPasswordInput" placeholder="Confirm password"
                                                    style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem; transition: border-color 0.2s;"
                                                    onfocus="this.style.borderColor='#4ade80';"
                                                    onblur="this.style.borderColor='#d1d5db';">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-top: 1rem; text-align: right;">
                                        <button type="submit"
                                            style="color: white; background-color: #007bff; border: none; padding: 0.5rem 1rem; border-radius: 0.375rem; transition: background-color 0.2s;">
                                            Change Password
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>



                    </div>
                    <div id="userBlogsTab" class="tab-content" style="display: none;">
                        <div class="container">
                            <div class="card"
                                style="background-color: white; font-family: Arial, sans-serif; color: #333;">
                                <div class="row cs_gap_y_24">
                                    @if ($blogs->isEmpty())
                                        <p style="text-align: center">No blogs found for this user.</p>
                                    @else
                                    @foreach ($blogs->sortByDesc('created_at') as $blog)
                                    <div class="col-lg-12 mb-4">
                                        <article class="cs_post cs_style_1 d-flex flex-wrap"
                                                 style="background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
                                            <!-- Blog Image -->
                                            <a href="{{ route('blogdetails', $blog->id) }}"
                                               class="cs_post_thumb cs_zoom overflow-hidden position-relative"
                                               style="flex: 1; width: 100%; max-width: 400px; border-radius: 8px;">
                                                @if ($blog->image_url)
                                                    <img src="{{ asset($blog->image_url) }}"
                                                         alt="{{ $blog->title }}"
                                                         class="cs_zoom_in img-fluid"
                                                         style="border-radius: 8px; object-fit: cover; height: 100%; width: 100%;">
                                                @endif

                                                <!-- Date Overlay -->
                                                <div class="cs_posted_by position-absolute"
                                                     style="bottom: 15px; right: 15px; background-color: rgba(0, 0, 0, 0.6); color: #fff; padding: 5px 10px; border-radius: 4px;">
                                                    <span class="cs_accent_bg cs_white_color">{{ $blog->created_at->format('d') }}</span>
                                                    <span class="cs_primary_bg cs_white_color">{{ $blog->created_at->format('F Y') }}</span>
                                                </div>
                                            </a>


                                            <!-- Blog Content -->
                                            <div class="cs_post_info d-flex align-items-start flex-column"
                                                 style="flex: 2; padding-left: 25px;">
                                                <!-- Author Avatar and Info -->
                                                <div class="cs_post_avatar d-flex align-items-center mb-3">
                                                    <div class="cs_avatar_thumb me-2">
                                                        <img src="{{ asset($blog->user->img) }}"
                                                             alt="Avatar"
                                                             class="rounded-circle img-fluid"
                                                             style="height: 50px; width: 50px; object-fit: cover;">
                                                    </div>
                                                    <div class="cs_avatar_info text-start">
                                                        <p class="mb-0" style="font-size: 14px; color: #888;">By.</p>
                                                        <strong style="font-size: 16px; color: #333;">{{ $blog->user->name }}</strong>
                                                    </div>
                                                </div>

                                                <!-- Blog Title -->
                                                <h2 class="cs_post_title cs_fs_24 cs_semibold"
                                                    style="font-weight: bold; color: #007bff; margin-top: 10px;">
                                                    <a href="{{ route('blogdetails', $blog->id) }}"
                                                       style="text-decoration: none; color: #007bff;">
                                                        {{ Str::limit($blog->title, 50) }}
                                                    </a>
                                                </h2>

                                                <!-- Blog Description -->
                                                <p class="cs_post_subtitle"
                                                   style="color: #555; line-height: 1.5; font-size: 15px; margin: 10px 0;">
                                                    {{ Str::limit($blog->description, 120) }}
                                                </p>

                                                <!-- Action Buttons (View & Comment) -->
                                                <div class="cs_post_btns cs_gray_bg_1 mt-auto"
                                                     style="margin-top: auto;">
                                                    <a href="{{ route('blogdetails', $blog->id) }}"
                                                       class="btn btn-primary"
                                                       style="margin-right: 10px;">
                                                        View
                                                    </a>
                                                    <a href="{{ route('blogdetails', $blog->id) }}"
                                                       class="btn btn-outline-secondary">
                                                        Comment
                                                    </a>
                                                </div>


                                                <!-- Dropdown Actions (Edit & Delete) -->
                                                <div class="cs_post_btns cs_gray_bg_1 text-start mt-3">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle"
                                                                type="button"
                                                                id="dropdownMenuButton-{{ $blog->id }}"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Settings
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end"
                                                            aria-labelledby="dropdownMenuButton-{{ $blog->id }}">
                                                            <!-- Nút Edit -->
                                                            <li>
                                                                <button class="dropdown-item"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editBlogModal"
                                                                        onclick="populateEditForm({{ $blog->id }}, '{{ $blog->title }}', '{{ $blog->description }}')">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </button>
                                                            </li>

                                                            <!-- Nút Delete -->
                                                            <li>
                                                                <form action="{{ route('blogs.permanentlyDelete', $blog->id) }}"
                                                                      method="POST"
                                                                      style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                            class="dropdown-item text-danger"
                                                                            onclick="return confirm('Are you sure you want to delete this blog?');">
                                                                        <i class="fas fa-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>



                                        </article>
                                    </div>
                                @endforeach



                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal chỉnh sửa blog -->
                    <div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editBlogForm" action="" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="edit_title" class="form-label">Title:</label>
                                            <input type="text" name="title" id="edit_title"
                                                class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_description" class="form-label">Description:</label>
                                            <textarea name="description" id="edit_description" class="form-control" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_image_url" class="form-label">Main Image:</label>
                                            <input type="file" name="image_url" id="edit_image_url"
                                                class="form-control" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_images" class="form-label">Additional Images:</label>
                                            <input type="file" name="images[]" id="edit_images"
                                                class="form-control" multiple accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Blog</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>









                    <div id="userFeedbackBlogsTab" class="tab-content" style="display: none;">
                        <div class="card"
                            style="background-color: white; font-family: Arial, sans-serif; color: #333;">
                            <!-- Hiển thị feedback -->
                            @if ($blogFeedbacks->isEmpty())
                                <p style="text-align: center">No feedback available.</p>
                            @else
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">#
                                            </th>
                                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Blog
                                            </th>
                                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Date
                                            </th>
                                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                Comment</th>
                                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                Rating</th>
                                            <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogFeedbacks->sortByDesc('created_at') as $feedback)
                                            <tr>
                                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                    {{ \Illuminate\Support\Str::words($feedback->blog->title ?? 'N/A', 2, '...') }}
                                                </td>
                                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                    {{ $feedback->created_at->format('Y-m-d') }}
                                                </td>
                                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                    {{ \Illuminate\Support\Str::words($feedback->comment, 5, '...') }}
                                                </td>
                                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                    {{ $feedback->rating }} stars
                                                </td>
                                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle"
                                                            type="button"
                                                            id="dropdownMenuButton-{{ $feedback->id }}"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton-{{ $feedback->id }}">
                                                            <!-- Nút View -->
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('blogdetails', $feedback->blog_id) }}">
                                                                    <i class="fas fa-eye"></i> View
                                                                </a>
                                                            </li>

                                                            <!-- Nút Edit chỉ hiển thị nếu người dùng có quyền -->
                                                            @if (Auth::check() && (Auth::user()->id === $feedback->user_id || Auth::user()->role === 'admin'))
                                                                <li>
                                                                    <button class="dropdown-item"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editModal-{{ $feedback->id }}">
                                                                        <i class="fas fa-edit"></i> Edit
                                                                    </button>
                                                                </li>
                                                            @endif

                                                            <!-- Nút Delete -->
                                                            <li>
                                                                <form
                                                                    action="{{ route('blogFeedback.destroy', $feedback->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this feedback?');"
                                                                    style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fas fa-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>

                                            </tr>

                                            <!-- Modal chỉnh sửa comment và rating -->
                                            <div class="modal fade" id="editModal-{{ $feedback->id }}"
                                                tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Feedback
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('blogFeedbacks.update', $feedback->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Comment -->
                                                                <div class="form-group mb-3">
                                                                    <label for="comment">Comment:</label>
                                                                    <textarea name="comment" id="comment" class="form-control" required>{{ old('comment', $feedback->comment) }}</textarea>
                                                                    @error('comment')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <!-- Rating -->
                                                                <div class="form-group mb-3">
                                                                    <label for="rating">Rating (1-5):</label>
                                                                    <input type="number" name="rating"
                                                                        id="rating" class="form-control"
                                                                        value="{{ old('rating', $feedback->rating) }}"
                                                                        min="1" max="5" required>
                                                                    @error('rating')
                                                                        <span
                                                                            class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Feedback</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>











                    <div id="userFeedbackTab" class="tab-content" style="display: none;">
                        <div class="card"
                            style="background-color: white; font-family: Arial, sans-serif; color: #333;">
                            <!-- Hiển thị feedback -->
                            @if ($feedbacks->isEmpty())
                                <p style="text-align: center">No feedback available.</p>
                            @else
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #ddd; padding: 8px;text-align: center;">#</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;text-align: center;">Beach
                                            </th>
                                            <th style="border: 1px solid #ddd; padding: 8px;text-align: center;">Date
                                            </th>
                                            <th style="border: 1px solid #ddd; padding: 8px;text-align: center;">
                                                Comment</th>
                                            <th style="border: 1px solid #ddd; padding: 8px;text-align: center;">Rating
                                            </th>
                                            <th style="border: 1px solid #ddd; padding: 8px;text-align: center;">Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($feedbacks->sortByDesc('created_at') as $feedback)
                                            <tr>
                                                <td style="border: 1px solid #ddd; padding: 8px;text-align: center;">
                                                    {{ $loop->iteration }}</td>
                                                <td style="border: 1px solid #ddd; padding: 8px;text-align: center;">
                                                    {{ $feedback->beach->name ?? 'N/A' }}</td>
                                                <td style="border: 1px solid #ddd; padding: 8px;text-align: center;">
                                                    {{ $feedback->created_at->format('Y-m-d') }}</td>
                                                <td style="border: 1px solid #ddd; padding: 8px;text-align: center;">
                                                    {{ Str::limit($feedback->message, 20, '...') }}</td>
                                                <!-- Giới hạn số từ hiển thị -->

                                                <td style="border: 1px solid #ddd; padding: 8px;text-align: center;">
                                                    {{ $feedback->rating }} stars</td>
                                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle"
                                                            type="button" id="dropdownMenuButton"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <!-- Nút View -->
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('destinationdetails', $feedback->beach->id) }}">
                                                                    <i class="fas fa-eye"></i> View
                                                                </a></li>

                                                            <!-- Nút Edit chỉ hiển thị nếu người dùng có quyền -->
                                                            @if (Auth::user()->id === $feedback->user_id || Auth::user()->role === 'admin')
                                                                <li><button type="button" class="dropdown-item"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editModal-{{ $feedback->id }}">
                                                                        <i class="fas fa-edit"></i> Edit
                                                                    </button></li>
                                                            @endif

                                                            <!-- Nút Delete -->
                                                            <li>
                                                                <form
                                                                    action="{{ route('feedback.destroy', $feedback->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="fas fa-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal chỉnh sửa comment và rating -->
                                            <div class="modal fade" id="editBlogModal" tabindex="-1"
                                                aria-labelledby="editBlogModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editBlogModalLabel">Edit Blog
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editBlogForm" action="" method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="edit_title"
                                                                        class="form-label">Title:</label>
                                                                    <input type="text" name="title"
                                                                        id="edit_title" class="form-control" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="edit_description"
                                                                        class="form-label">Description:</label>
                                                                    <textarea name="description" id="edit_description" class="form-control" required></textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="edit_image_url"
                                                                        class="form-label">Main Image:</label>
                                                                    <input type="file" name="image_url"
                                                                        id="edit_image_url" class="form-control"
                                                                        accept="image/*">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="edit_images"
                                                                        class="form-label">Additional Images:</label>
                                                                    <input type="file" name="images[]"
                                                                        id="edit_images" class="form-control" multiple
                                                                        accept="image/*">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Blog</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function populateEditForm(blogId, title, description) {
                                                    // Cập nhật action của form để chỉ đến blog cụ thể
                                                    document.getElementById('editBlogForm').action = '/blogs/' + blogId;

                                                    // Cập nhật giá trị các trường
                                                    document.getElementById('edit_title').value = title;
                                                    document.getElementById('edit_description').value = description;
                                                }
                                            </script>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>








                    <div id="privacyPolicyTab" class="tab-content" style="display: none;">
                        <div class="card"
                            style=" padding: 3rem; background-color: white; font-family: Arial, sans-serif; color: #333; text-align: justify;">
                            <h5 style="font-weight: bold; margin-bottom: 0.5rem;">1. Information We Collect
                            </h5>
                            <p>We may collect personal information such as:</p>
                            <ul style="margin-left: 1.5rem; list-style-type: disc;">
                                <li>Name</li>
                                <li>Email address</li>
                                <li>Phone number</li>
                                <li>Payment information</li>
                                <li>Address</li>
                                <li>Date of Birth</li>
                                <li>Profile picture</li>
                                <li>Preferences and interests</li>
                            </ul>

                            <h5 style="font-weight: bold; margin-bottom: 0.5rem;">2. How We Use Your
                                Information</h5>
                            <p>Your personal information may be used to:</p>
                            <ul style="margin-left: 1.5rem; list-style-type: disc;">
                                <li>Provide and maintain our services</li>
                                <li>Notify you of changes to our services</li>
                                <li>Offer customer support</li>
                                <li>Send marketing communications</li>
                                <li>Personalize user experience</li>
                                <li>Conduct research and analysis</li>
                                <li>Comply with legal obligations</li>
                            </ul>

                            <h5 style="font-weight: bold; margin-bottom: 0.5rem;">3. Data Security</h5>
                            <p>We implement various security measures to protect your personal information.
                                However, no
                                method
                                of transmission over the internet is 100% secure. We strive to protect your
                                information but
                                cannot guarantee its absolute security.</p>

                            <h5 style="font-weight: bold; margin-bottom: 0.5rem;">4. Sharing Information</h5>
                            <p>We do not sell or trade your personal information without your consent, except as
                                required by
                                law. We may share your information with:</p>
                            <ul style="margin-left: 1.5rem; list-style-type: disc;">
                                <li>Service providers to assist in our operations</li>
                                <li>Law enforcement if required</li>
                                <li>Business partners for marketing purposes (with consent)</li>
                            </ul>

                            <h5 style="font-weight: bold; margin-bottom: 0.5rem;">5. Your Rights</h5>
                            <p>You have the right to access, modify, or delete your personal information. Please
                                contact us
                                to
                                exercise these rights. You also have the right to:</p>
                            <ul style="margin-left: 1.5rem; list-style-type: disc;">
                                <li>Request a copy of your personal data</li>
                                <li>Withdraw consent at any time</li>
                                <li>Object to processing your data</li>
                            </ul>

                            <h5 style="font-weight: bold; margin-bottom: 0.5rem;">6. Changes to This Policy
                            </h5>
                            <p>We may update this Privacy Policy from time to time. Any changes will be
                                reflected in the
                                effective date above. We encourage you to review this policy periodically.</p>

                            <h5 style="font-weight: bold; margin-bottom: 0.5rem;">7. Contact Us</h5>
                            <p>For questions about this Privacy Policy, please contact us at:</p>
                            <ul style="margin-left: 1.5rem; list-style-type: disc;">
                                <li>Email: <a href="mailto:email@example.com">email@example.com</a></li>
                                <li>Phone: [Phone Number]</li>
                                <li>Address: [Your Company Address]</li>
                                <li>Website: <a href="http://yourwebsite.com">yourwebsite.com</a></li>
                            </ul>
                        </div>
                    </div>



                </div>
                    <!-- End Info Section -->


                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Lấy tất cả các liên kết tab
                        const tabLinks = document.querySelectorAll('[data-tab-toggle]');

                        // Gắn sự kiện click cho mỗi liên kết
                        tabLinks.forEach(link => {
                            link.addEventListener('click', function() {
                                // Ẩn tất cả các nội dung tab
                                const allTabs = document.querySelectorAll('.tab-content');
                                allTabs.forEach(tab => tab.style.display = 'none');

                                // Hiển thị tab tương ứng
                                const targetTab = document.getElementById(this.getAttribute('data-target'));
                                if (targetTab) {
                                    targetTab.style.display = 'block';
                                }
                            });
                        });
                    });
                </script>
            </div>

        </div>




        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <style>
            .nav-tabs {
                display: flex;
                justify-content: center;
                /* Căn giữa các tab */
                flex-wrap: wrap;
                /* Cho phép các tab xuống dòng */
                padding: 0;
                /* Xóa padding mặc định */
                margin: 20px 0;
                /* Margin trên và dưới cho các tab */
            }

            .nav-tabs .group {
                margin: 10px;
                /* Khoảng cách giữa các nút */
                flex: 1 0 30%;
                /* Chiều rộng cho mỗi nút */
                text-align: center;
                /* Căn giữa văn bản trong các nút */
            }

            /* Nếu bạn muốn điều chỉnh chiều rộng của các tab */
            .tab-link {
                padding: 10px 20px;
                /* Điều chỉnh khoảng cách trong nút */
                display: inline-block;
                /* Đảm bảo nút là khối inline */
            }
        </style>
        <style>
            .cs_posted_by {
                position: absolute;
                /* Giữ nguyên vị trí tuyệt đối */


                background-color: hsla(0, 0%, 1%, 0.502);
                /* Màu nền cho khung */

                padding: 10px;
                /* Khoảng cách bên trong khung */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
                /* Bóng cho khung */
            }

            .date-day,
            .date-month-year {

                padding: 5px;
                /* Khoảng cách bên trong */
                display: inline-block;
                /* Hiển thị inline-block để có thể căn chỉnh */

            }

            .date-day {
                background-color: rgba(18, 118, 225, 0.7);
                /* Màu nền cho ngày */
            }

            .date-month-year {
                background-color: rgba(0, 123, 255, 0.5);
                /* Màu nền cho tháng và năm */
            }

            .cs_white_color {
                color: #fff;
                /* Màu chữ trắng */
            }

            .cs_post_btns {
                display: flex;
                /* Sử dụng flexbox để căn chỉnh các nút */
                gap: 10px;
                /* Khoảng cách giữa các nút */
                padding: 10px;
                /* Khoảng cách bên trong */
                background-color: #f7f7f7;
                /* Màu nền cho khung */
                border-radius: 8px;
                /* Góc bo cho khung */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                /* Bóng cho khung */
            }

            .cs_comment_btn,
            .cs_post_btn {
                display: flex;
                /* Căn chỉnh biểu tượng và văn bản theo hàng ngang */
                align-items: center;
                /* Căn giữa theo chiều dọc */
                text-decoration: none;
                /* Xóa gạch chân */
                color: #333;
                /* Màu chữ */
                padding: 10px 15px;
                /* Khoảng cách bên trong */
                border-radius: 5px;
                /* Góc bo cho các nút */
                transition: background-color 0.3s ease;
                /* Hiệu ứng chuyển màu nền */
            }

            .cs_comment_btn:hover,
            .cs_post_btn:hover {
                background-color: rgba(0, 0, 0, 0.1);
                /* Màu nền khi hover */
            }

            .cs_post_btn.cs_primary_bg {
                background-color: #007bff;
                /* Màu nền cho nút "More" */
                color: #fff;
                /* Màu chữ trắng */
            }

            .cs_post_btn.cs_primary_bg:hover {
                background-color: #0056b3;
                /* Màu nền khi hover cho nút "More" */
            }

            svg {
                margin-right: 10px;
                /* Khoảng cách giữa biểu tượng và văn bản */
                fill: currentColor;
                /* Sử dụng màu hiện tại cho biểu tượng */
            }
        </style>
</body>

</html>
