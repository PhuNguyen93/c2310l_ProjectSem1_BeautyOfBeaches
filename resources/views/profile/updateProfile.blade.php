<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <title> Update Profile</title>
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
    </style>
</head>

<body>

    <section id="content" class="container">

        <div class="page-heading">
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
                        style="max-width: 800px; margin: auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                        <div class="card-body">
                            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <h3 style="font-weight: bold; margin-bottom: 20px; color: #4A4A4A;">Personal Information
                                </h3>

                                <div class="grid"
                                    style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                                    <div>
                                        <label for="firstName" class="block mb-2 text-base font-medium"
                                            style="color: #333;">Name</label>
                                        <input type="text" id="firstName" name="name"
                                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 4px; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                            placeholder="Enter your value" value="{{ old('name', $user->name) }}"
                                            required>
                                    </div>

                                    <div>
                                        <label for="phoneNumber" class="block mb-2 text-base font-medium"
                                            style="color: #333;">Phone Number</label>
                                        <input type="text" id="phoneNumber" name="phone"
                                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 4px; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                            placeholder="" value="{{ old('phone', $user->phone) }}">
                                    </div>

                                    <div>
                                        <label for="emailInput" class="block mb-2 text-base font-medium"
                                            style="color: #333;">Email Address</label>
                                        <input type="email" id="emailInput" name="email"
                                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 4px; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                            placeholder="Enter your email address"
                                            value="{{ old('email', $user->email) }}">
                                    </div>

                                    <div>
                                        <label for="birthDateInput" class="block mb-2 text-base font-medium"
                                            style="color: #333;">Birth Date</label>
                                        <input type="date" id="birthDateInput" name="birth_date"
                                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 4px; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                            value="{{ old('birth_date', $user->birth_date) }}">
                                    </div>

                                    <div>
                                        <label for="countryInput" class="block mb-2 text-base font-medium"
                                            style="color: #333;">Country</label>
                                        <input type="text" id="countryInput" name="country"
                                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 4px; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                            placeholder="Enter your value" value="{{ old('country', $user->country) }}">
                                    </div>

                                    <div>
                                        <label for="joiningDateInput" class="block mb-2 text-base font-medium"
                                            style="color: #333;">Joining Date</label>
                                        <input type="text" id="joiningDateInput" name="joining_date"
                                            style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 4px; background-color: #f9fafb; transition: border-color 0.2s; box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);"
                                            value="{{ $user->created_at }}" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="flex justify-end mt-6 gap-x-4"
                                    style="position: relative; margin-left: 585px;">
                                    <button type="submit"
                                        style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.2s; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                                        Update
                                    </button>
                                    <button type="button"
                                        style="padding: 10px 20px; background-color: rgb(224, 65, 56); color: white; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.2s; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                                        Cancel
                                    </button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel"
                    style="border: 1px solid #ddd; background-color: white; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 20px auto;">
                    <div class="panel-heading"
                        style="background-color: #f5f5f5; border-bottom: 1px solid #ddd; text-align: center;">
                        <span class="panel-icon" style="margin-right: 10px;">
                            <i class="fa fa-star" style="color: #f39c12;"></i>
                        </span>
                        <span class="panel-title" style="font-weight: bold;">User Popularity</span>
                    </div>
                    <div class="panel-body pn" style="padding: 20px;">
                        <table class="table table-striped" style="text-align: center; margin-bottom: 0;">

                            <tbody>
                                <tr>
                                    <td>
                                        <span class="fa fa-desktop text-warning"></span>
                                    </td>
                                    <td>Television</td>
                                    <td>
                                        <i class="fa fa-caret-up text-info pr10"></i>$855,913
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fa fa-microphone text-primary"></span>
                                    </td>
                                    <td>Radio</td>
                                    <td>
                                        <i class="fa fa-caret-down text-danger pr10"></i>$349,712
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="fa fa-newspaper-o text-info"></span>
                                    </td>
                                    <td>Newspaper</td>
                                    <td>
                                        <i class="fa fa-caret-up text-info pr10"></i>$1,259,742
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel"
                    style="border: 1px solid #ddd; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 20px auto; border-radius: 8px;">
                    <div class="panel-heading"
                        style="background-color: #f7f7f7; border-bottom: 1px solid #ddd; padding: 15px; text-align: center; border-radius: 8px 8px 0 0;">
                        <span class="panel-icon" style="margin-right: 10px;">
                            <i class="fa fa-trophy" style="color: #f39c12; font-size: 18px;"></i>
                        </span>
                        <span class="panel-title" style="font-weight: bold; font-size: 18px;">My Skills</span>
                    </div>
                    <div class="panel-body" style="padding: 20px;">
                        {{-- <div style="display: flex; flex-wrap: wrap; justify-content: center;">
                            <span class="label label-warning"
                                style="margin: 5px; padding: 10px 15px; font-size: 14px; border-radius: 5px;">Default</span>
                            <span class="label label-primary"
                                style="margin: 5px; padding: 10px 15px; font-size: 14px; border-radius: 5px;">Primary</span>
                            <span class="label label-info"
                                style="margin: 5px; padding: 10px 15px; font-size: 14px; border-radius: 5px;">Success</span>
                            <span class="label label-success"
                                style="margin: 5px; padding: 10px 15px; font-size: 14px; border-radius: 5px;">Info</span>
                            <span class="label label-alert"
                                style="margin: 5px; padding: 10px 15px; font-size: 14px; border-radius: 5px;">Warning</span>
                            <span class="label label-system"
                                style="margin: 5px; padding: 10px 15px; font-size: 14px; border-radius: 5px;">Danger</span>
                            <span class="label label-info"
                                style="margin: 5px; padding: 10px 15px; font-size: 14px; border-radius: 5px;">Success</span>
                            <span class="label label-success"
                                style="margin: 5px; padding: 10px 15px; font-size: 14px; border-radius: 5px;">UI
                                Design</span>
                            <span class="label label-primary"
                                style="margin: 5px; padding: 10px 15px; font-size: 14px; border-radius: 5px;">Primary</span>
                        </div> --}}
                    </div>
                </div>


                <div class="panel"
                    style="border: 1px solid #ddd; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 20px auto; border-radius: 8px;">
                    <div class="panel-heading"
                        style="background-color: #f7f7f7; border-bottom: 1px solid #ddd; padding: 15px; text-align: center; border-radius: 8px 8px 0 0;">
                        <span class="panel-icon" style="margin-right: 10px;">
                            <i class="fa fa-pencil" style="color: #3498db; font-size: 18px;"></i>
                        </span>
                        <span class="panel-title" style="font-weight: bold; font-size: 18px;">About Me</span>
                    </div>
                    <div class="panel-body" style="padding: 20px; text-align: left;">
                        <h6 style="font-weight: bold; font-size: 16px;">Experience</h6>
                        <h4 style="color: #333;">Facebook Internship</h4>
                        <p class="text-muted" style="color: #777;">University of Missouri, Columbia
                            <br> Student Health Center, June 2010 - 2012
                        </p>
                        <hr class="short br-lighter" style="border-color: #eee;">
                        <h6 style="font-weight: bold; font-size: 16px;">Education</h6>
                        <h4 style="color: #333;">Bachelor of Science, PhD</h4>
                        <p class="text-muted" style="color: #777;">University of Missouri, Columbia
                            <br> Student Health Center, June 2010 through Aug 2011
                        </p>
                        <hr class="short br-lighter" style="border-color: #eee;">
                        <h6 style="font-weight: bold; font-size: 16px;">Accomplishments</h6>
                        <h4 style="color: #333;">Successful Business</h4>
                        <p class="text-muted" style="color: #777;">University of Missouri, Columbia
                            <br> Student Health Center, June 2010 through Aug 2011
                        </p>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="tab-block">
                    <ul class="nav nav-tabs">
                        <li class="group active">
                            <a href="javascript:void(0);" data-tab-toggle data-target="changePasswordTabs"
                                class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">Change
                                Password</a>
                        </li>
                        {{-- <li class="group">
                            <a href="javascript:void(0);" data-tab-toggle data-target="historyTabs"
                                class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">History</a>
                        </li> --}}
                        <li class="group">
                            <a href="javascript:void(0);" data-tab-toggle data-target="privacyPolicyTabs"
                                class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">Privacy
                                Policy</a>
                        </li>

                    </ul>

                    <div class="nav nav-tabs">
                        <!-- Change Password Tab Content -->
                        <!-- Change Password Tab Content -->
                        <div class="tab-pane" id="changePasswordTabs">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('change.password', ['id' => $user->id]) }}" method="POST"
                                        style="border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 1rem; background-color: white;">
                                        @csrf <!-- Bảo vệ chống tấn công CSRF -->
                                        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                                            <div class="form-group">
                                                <label for="oldpasswordInput"
                                                    class="inline-block mb-2 text-base font-medium">Old
                                                    Password*</label>
                                                <div class="relative">
                                                    <input type="password" name="old_password" id="oldpasswordInput"
                                                        placeholder="Enter current password"
                                                        style="border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem; width: 30%; transition: border-color 0.2s;"
                                                        onfocus="this.style.borderColor='#4ade80';"
                                                        onblur="this.style.borderColor='#d1d5db';">
                                                </div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="newpasswordInput"
                                                    class="inline-block mb-2 text-base font-medium">New
                                                    Password*</label>
                                                <div class="relative">
                                                    <input type="password" name="new_password" id="newpasswordInput"
                                                        placeholder="Enter new password"
                                                        style="border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem; width: 30%; transition: border-color 0.2s;"
                                                        onfocus="this.style.borderColor='#4ade80';"
                                                        onblur="this.style.borderColor='#d1d5db';">
                                                </div>
                                            </div><!-- end form-group -->

                                            <div class="form-group">
                                                <label for="confirmPasswordInput"
                                                    class="inline-block mb-2 text-base font-medium">Confirm
                                                    Password*</label>
                                                <div class="relative">
                                                    <input type="password" name="new_password_confirmation"
                                                        id="confirmPasswordInput" placeholder="Confirm password"
                                                        style="border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 0.5rem; width: 30%; transition: border-color 0.2s;"
                                                        onfocus="this.style.borderColor='#4ade80';"
                                                        onblur="this.style.borderColor='#d1d5db';">
                                                </div>
                                            </div><!-- end form-group -->

                                            <div class="form-group flex justify-end xl:col-span-3">
                                                <button type="submit"
                                                    style="margin-top: 1rem; color: white; background-color: #007bff; border: 1px solid #48bb78; padding: 0.5rem 1rem; border-radius: 0.375rem; transition: background-color 0.2s, border-color 0.2s;">
                                                    Change Password
                                                </button>
                                            </div><!-- end form-group -->
                                        </div><!-- end grid -->
                                    </form>
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
                        </div>




                        <!-- Privacy Policy Tab Content -->
                        <div class="tab-pane hidden" id="privacyPolicyTabs">
                            <div class="privacy-policy"
                                style="border: 1px solid #d1d5db; border-radius: 0.375rem; padding: 1rem; background-color: white; font-family: Arial, sans-serif; color: #333;">
                                <h5 style="font-weight: bold; margin-bottom: 0.5rem;">1. Information We Collect</h5>
                                <p>We may collect personal information such as:</p>
                                <ul style="margin-left: 1.5rem; list-style-type: disc;">
                                    <li>Name</li>
                                    <li>Email address</li>
                                    <li>Phone number</li>
                                    <li>Payment information</li>
                                </ul>

                                <h5 style="font-weight: bold; margin-bottom: 0.5rem;">2. How We Use Your Information
                                </h5>
                                <p>Your personal information may be used to:</p>
                                <ul style="margin-left: 1.5rem; list-style-type: disc;">
                                    <li>Provide and maintain our services</li>
                                    <li>Notify you of changes</li>
                                    <li>Offer customer support</li>
                                    <li>Send marketing communications</li>
                                </ul>

                                <h5 style="font-weight: bold; margin-bottom: 0.5rem;">3. Data Security</h5>
                                <p>We implement various security measures to protect your personal information. However,
                                    no method of transmission over the internet is 100% secure.</p>

                                <h5 style="font-weight: bold; margin-bottom: 0.5rem;">4. Sharing Information</h5>
                                <p>We do not sell or trade your personal information without your consent, except as
                                    required by law.</p>

                                <h5 style="font-weight: bold; margin-bottom: 0.5rem;">5. Your Rights</h5>
                                <p>You have the right to access, modify, or delete your personal information. Please
                                    contact us to exercise these rights.</p>

                                <h5 style="font-weight: bold; margin-bottom: 0.5rem;">6. Changes to This Policy</h5>
                                <p>We may update this Privacy Policy from time to time. Any changes will be reflected in
                                    the effective date above.</p>

                                <h5 style="font-weight: bold; margin-bottom: 0.5rem;">7. Contact Us</h5>
                                <p>For questions about this Privacy Policy, please contact us at:</p>
                                <ul style="margin-left: 1.5rem; list-style-type: disc;">
                                    <li>Email: <a href="mailto:email@example.com">email@example.com</a></li>
                                    <li>Phone: [Phone Number]</li>
                                </ul>
                            </div>
                        </div>


                        <!-- History Tab Content -->
                        {{-- <div class="tab-pane hidden" id="historyTabs">


                            <table class="table table-striped"
                                style="background-color: white; border: 1px solid #ddd;">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th>Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Example history items -->
                                    <tr>
                                        <td>Activity 1</td>
                                        <td>2024-10-01 10:00</td>
                                        <td>
                                            <button class="btn btn-info">View</button>
                                            <button class="btn btn-warning">Edit</button>
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Activity 2</td>
                                        <td>2024-10-02 11:30</td>
                                        <td>
                                            <button class="btn btn-info">View</button>
                                            <button class="btn btn-warning">Edit</button>
                                            <button class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Add more history items as needed -->
                                </tbody>
                            </table>
                        </div> --}}

                    </div>
                </div>

                <script>
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

                    // Hiển thị tab đầu tiên mặc định
                    document.getElementById('changePasswordTabs').classList.remove('hidden');
                </script>
            </div>

        </div>
    </section>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>
