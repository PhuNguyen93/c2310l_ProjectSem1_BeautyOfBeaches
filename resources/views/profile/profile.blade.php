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
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">{{ $user->name }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">{{ $user->email }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">{{ $user->phone }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Country</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">{{ $user->country ?? 'Not provided' }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Birthday</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') : 'Not provided' }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Joining Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</div>
                            </div>


                        </div>



                        <div class="row gutters-sm">

                            <div class="tab-block">
                                <ul class="nav nav-tabs"
                                    style="display: flex; justify-content: center; padding: 0; margin: 20px 20px;">
                                    <li class="group">
                                        <a href="http://127.0.0.1:8000"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                            Home
                                        </a>
                                    </li>

                                    <li class="group">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="updateProfileTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                            Update Profile
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="changePasswordTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                            Change Password
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="userHistoryTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                            User History
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a href="javascript:void(0);" data-tab-toggle data-target="privacyPolicyTab"
                                            class="tab-link inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                            Privacy Policy
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Nội dung các tab -->



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
                                                value="{{ old('email', $user->email) }}">
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

                    <div id="userHistoryTab" class="tab-content" style="display: none;">

                        <div class="card"
                            style=" background-color: white; font-family: Arial, sans-serif; color: #333;">

                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Activity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dữ liệu mẫu, bạn có thể thay thế bằng dữ liệu động -->
                                    <tr>
                                        <td>1</td>
                                        <td>2024-10-06</td>
                                        <td>Commented on "Amazing Beach" blog</td>
                                        <td>
                                            <button class="btn btn-info btn-sm">View</button>
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2024-10-05</td>
                                        <td>Wrote blog "Top 10 Beaches to Visit"</td>
                                        <td>
                                            <button class="btn btn-info btn-sm">View</button>
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>2024-10-04</td>
                                        <td>Updated profile information</td>
                                        <td>
                                            <button class="btn btn-info btn-sm">View</button>
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Kết thúc dữ liệu mẫu -->
                                </tbody>
                            </table>
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
</body>

</html>
