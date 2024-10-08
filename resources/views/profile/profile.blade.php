<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <title> Profile And Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 50px;
            background: #eee;
        }



        .page-heading {
            position: relative;
            padding: 30px 40px;
            s margin: -25px -20px 25px;
            border-bottom: 1px solid #d9d9d9;
            background-color: #f2f2f2;
        }

        /* CSS cho bảng */
        .table {
            width: 100%;
            /* Chiếm toàn bộ chiều rộng */
            border-collapse: collapse;
            /* Xóa khoảng cách giữa các ô */
            margin-top: 15px;
            /* Khoảng cách trên bảng */
        }

        .table th,
        .table td {
            padding: 15px;
            /* Khoảng cách bên trong các ô */
            text-align: center;
            /* Căn giữa văn bản trong ô */
            border: 1px solid #d1d5db;
            /* Viền cho các ô */
        }

        .table th {
            background-color: #f8f9fa;
            /* Màu nền cho tiêu đề */
            color: #333;
            /* Màu chữ tiêu đề */
            font-weight: bold;
            /* Chữ đậm cho tiêu đề */
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
            /* Màu nền cho các hàng lẻ */
        }

        .table-striped tbody tr:hover {
            background-color: #e2e6ea;
            /* Màu nền khi hover */
        }

        .btn {
            margin: 0 5px;
            /* Khoảng cách giữa các nút */
        }
    </style>
</head>

<body>

    <section id="content" class="container">

        <div class="page-heading"
            style="max-width: 1200px; margin: auto; padding: 20px; background-color: rgb(228, 234, 240); border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
            <div class="media clearfix">
                <div class="media-left pr30">
                    <form action="{{ route('profile.upload_avatar') }}" method="POST" enctype="multipart/form-data"
                        id="UpdateAvatar" style="text-align: center;">
                        @csrf
                        <div class="lg:col-span-2 2xl:col-span-1">
                            <div
                                class="relative inline-block size-20 rounded-full shadow-md bg-slate-100 profile-user xl:size-28">
                                <input id="profile-img-file-input" type="file" name="avatar"
                                    class="hidden profile-img-file-input" accept="image/*" required>
                                <label for="profile-img-file-input" style="cursor: pointer;">
                                    <img src="{{ asset($user->img) }}" alt="Avatar" class="media-object"
                                        style="width: 200px; height: 200px; border: 2px solid #d1d5db; border-radius: 50%; ">
                                </label>
                                <div
                                    class="absolute bottom-0 flex items-center justify-center size-8 rounded-full ltr:right-0 rtl:left-0 profile-photo-edit">
                                    <label for="profile-img-file-input"
                                        class="flex items-center justify-center size-8 bg-white rounded-full shadow-lg cursor-pointer dark:bg-zink-600 profile-photo-edit">
                                        <i data-lucide="image-plus"
                                            class="size-4 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <h2 class="media-heading" style="text-align: center; color: #333;">{{ $user->name }}</h2>
                    </form>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Lắng nghe sự kiện change trên input file
                        document.getElementById('profile-img-file-input').addEventListener('change', function() {
                            // Kiểm tra xem có file được chọn hay không
                            if (this.files && this.files[0]) {
                                // Submit form khi người dùng đã chọn ảnh
                                document.getElementById('UpdateAvatar').submit();
                            }
                        });
                    });
                </script>


                <div class="media-body va-m">
                    <div class="card"
                        style="max-width: 800px; margin: auto; padding: 20px; background-color: #f8f9fa; border-radius: 12px; ">
                        {{-- <h5 class="card-title text-center mb-4">User Profile</h5> --}}
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Full Name:</label>
                                    <div class="text-secondary">{{ $user->name }}</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Email:</label>
                                    <div class="text-secondary">{{ $user->email }}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Phone:</label>
                                    <div class="text-secondary">{{ $user->phone }}</div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Country:</label>
                                    <div class="text-secondary">{{ $user->country ?? 'Not provided' }}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Birthday:</label>
                                    <div class="text-secondary">
                                        {{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') : 'Not provided' }}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Joining Date:</label>
                                    <div class="text-secondary">
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-block">

                    <ul class="nav nav-tabs"
                        style="display: flex; justify-content: center; padding: 0; margin: 20px 0;">

                        <li class="group ">
                            <a href="http://127.0.0.1:8000"
                                class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                Home
                            </a>
                        </li>
                        <!-- Tab Update Profile -->

                        <li class="group ">
                            <a href="javascript:void(0);" data-tab-toggle data-target="updateProfileTabs"
                                class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                Update Profile
                            </a>
                        </li>

                        <!-- Tab Change Password -->
                        <li class="group">
                            <a href="javascript:void(0);" data-tab-toggle data-target="changePasswordTabs"
                                class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                Change Password
                            </a>
                        </li>

                        <!-- Tab User History -->
                        <li class="group">
                            <a href="javascript:void(0);" data-tab-toggle data-target="userHistoryTabs"
                                class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                User History
                            </a>
                        </li>

                        <!-- Tab Privacy Policy -->
                        <li class="group">
                            <a href="javascript:void(0);" data-tab-toggle data-target="privacyPolicyTabs"
                                class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                Privacy Policy
                            </a>
                        </li>
                    </ul>

                </div>


            </div>

            <!-- Update Profile Tab Content -->
            <div class="tab-pane" id="updateProfileTabs">
                <div class="card"
                    style="border: 1px solid #d1d5db; border-radius: 12px; padding: 3rem; background-color: white; font-family: Arial, sans-serif; color: #333;">
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
                                        placeholder="Enter your value" value="{{ old('country', $user->country) }}">
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




            <!-- Change Password Tab Content -->
            <!-- Change Password Tab Content -->
            <div class="tab-pane" id="changePasswordTabs">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('change.password', ['id' => $user->id]) }}" method="POST"
                            style="border: 1px solid #d1d5db; border-radius: 12px; padding: 3rem; background-color: white;">
                            @csrf <!-- Bảo vệ chống tấn công CSRF -->

                            <div style="display: flex; justify-content: space-between; gap: 1rem;">
                                <div class="form-group" style="flex: 1;">
                                    <label for="oldpasswordInput" class="inline-block mb-2 text-base font-medium">Old
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
                                    <label for="newpasswordInput" class="inline-block mb-2 text-base font-medium">New
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




            <!-- Privacy Policy Tab Content -->
            <div class="tab-pane" id="userHistoryTabs">
                <div class="card"
                    style=" border-radius: 12px; background-color: white; font-family: Arial, sans-serif; color: #333;">

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





            <div class="tab-pane " id="privacyPolicyTabs">
                <div class="card"
                    style="border: 1px solid #d1d5db; border-radius: 12px; padding: 3rem; background-color: white; font-family: Arial, sans-serif; color: #333; text-align: justify;">
                    <h5 style="font-weight: bold; margin-bottom: 0.5rem;">1. Information We Collect</h5>
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

                    <h5 style="font-weight: bold; margin-bottom: 0.5rem;">2. How We Use Your Information</h5>
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
                    <p>We implement various security measures to protect your personal information. However, no method
                        of transmission over the internet is 100% secure. We strive to protect your information but
                        cannot guarantee its absolute security.</p>

                    <h5 style="font-weight: bold; margin-bottom: 0.5rem;">4. Sharing Information</h5>
                    <p>We do not sell or trade your personal information without your consent, except as required by
                        law. We may share your information with:</p>
                    <ul style="margin-left: 1.5rem; list-style-type: disc;">
                        <li>Service providers to assist in our operations</li>
                        <li>Law enforcement if required</li>
                        <li>Business partners for marketing purposes (with consent)</li>
                    </ul>

                    <h5 style="font-weight: bold; margin-bottom: 0.5rem;">5. Your Rights</h5>
                    <p>You have the right to access, modify, or delete your personal information. Please contact us to
                        exercise these rights. You also have the right to:</p>
                    <ul style="margin-left: 1.5rem; list-style-type: disc;">
                        <li>Request a copy of your personal data</li>
                        <li>Withdraw consent at any time</li>
                        <li>Object to processing your data</li>
                    </ul>

                    <h5 style="font-weight: bold; margin-bottom: 0.5rem;">6. Changes to This Policy</h5>
                    <p>We may update this Privacy Policy from time to time. Any changes will be reflected in the
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




    </section>

    <script>
        // Ẩn tất cả các tab ngay từ đầu
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.add('hidden');
        });

        // Hiện tab đầu tiên khi trang tải (nếu cần)
        // document.querySelector('.tab-pane').classList.remove('hidden'); // Bỏ dòng này nếu không muốn hiện tab đầu tiên

        // Thêm sự kiện click cho tất cả các tab
        document.querySelectorAll('[data-tab-toggle]').forEach(tab => {
            tab.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                console.log("Clicked tab:", target); // Kiểm tra xem sự kiện có hoạt động hay không

                // Ẩn tất cả các tab
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                });

                // Hiện tab được chọn
                document.getElementById(target).classList.remove('hidden');

                // Cập nhật trạng thái active cho các tab
                document.querySelectorAll('.group').forEach(group => {
                    group.classList.remove('active');
                });
                this.parentElement.classList.add('active');
            });
        });
    </script>

    </div>

    </div>



    </section>
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
