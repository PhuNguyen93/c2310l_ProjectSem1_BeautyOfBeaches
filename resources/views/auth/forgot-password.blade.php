@extends('layouts.master-without-nav')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
    <style>
        .form-input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.4);
        }

        .btn {
            background-color: #4A90E2;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn:hover {
            background-color: #357ABD;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
        }

        .shadow-lg {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>

    <body
        class="flex items-center justify-center min-h-screen py-16 lg:py-10 bg-slate-50 dark:bg-zink-800 dark:text-zink-100 font-public"
        x-data="{ step: '{{ session('otp_verified') ? 'reset' : (session('otp_sent') ? 'verify' : 'send') }}' }">

        <div class="relative">
            <!-- SVG decoration elements -->
            <div class="absolute hidden opacity-50 ltr:-left-16 rtl:-right-16 -top-10 md:block">
                <!-- SVG content -->
            </div>

            <div class="absolute hidden -rotate-180 opacity-50 ltr:-right-16 rtl:-left-16 -bottom-10 md:block">
                <!-- SVG content -->
            </div>

            <div class="mb-0 w-screen lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
                <div class="!px-10 !py-12 card-body">
                    <a href="#!">
                        <img src="{{ URL::asset('build/images/logo-light.png') }}" alt=""
                            class="hidden h-6 mx-auto dark:block">
                        <img src="{{ URL::asset('assets/images/logo.png') }}" alt=""
                            class="block h-6 mx-auto dark:hidden">
                        {{-- <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" class="block h-6 mx-auto dark:hidden"> --}}
                    </a>

                    <div class="mt-8 text-center">
                        <h4 class="mb-2 text-custom-500 dark:text-custom-500">Forgot Password?</h4>
                    </div>
                    <!-- Form gửi OTP -->
                    <form method="POST" id="send-otp-form" action="{{ route('sendOtpForReset') }}">
                        @csrf
                        <div>
                            <label for="emailInput" class="inline-block mb-2 text-base font-medium">Email</label>
                            <input type="email" name="email"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                required placeholder="Enter email" id="emailInput">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Send OTP</button>
                    </form>


                    <!-- Form xác thực OTP -->

                    <form method="POST" id="verify-otp-form" action="{{ route('verifyOtp') }}">
                        @csrf
                        <div>
                            <label for="otpInput" class="inline-block mb-2 text-base font-medium">Enter OTP</label>
                            <input type="text" name="otp"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                required placeholder="Enter OTP" id="otpInput">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Confirm OTP</button>
                    </form>


                    <!-- Form reset mật khẩu -->

                    <form method="POST" id="reset-password-form" action="{{ route('resetPassword') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('reset_email') }}">

                        <div class="mb-4">
                            <label for="new_password" class="inline-block mb-2 text-base font-medium">New Password</label>
                            <input type="password" name="new_password" id="new_password"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                required placeholder="Enter new password">
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="inline-block mb-2 text-base font-medium">Confirm New
                                Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                                required placeholder="Confirm new password">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-full">
                                Confirm
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- SweetAlert thông báo thành công -->
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const step = '{{ session('otp_verified') ? 'reset' : (session('otp_sent') ? 'verify' : 'send') }}';

                // Hiển thị form dựa trên bước hiện tại
                if (step === 'send') {
                    document.getElementById('send-otp-form').style.display = 'block';
                    document.getElementById('verify-otp-form').style.display = 'none';
                    document.getElementById('reset-password-form').style.display = 'none';
                } else if (step === 'verify') {
                    document.getElementById('send-otp-form').style.display = 'none';
                    document.getElementById('verify-otp-form').style.display = 'block';
                    document.getElementById('reset-password-form').style.display = 'none';
                } else if (step === 'reset') {
                    document.getElementById('send-otp-form').style.display = 'none';
                    document.getElementById('verify-otp-form').style.display = 'none';
                    document.getElementById('reset-password-form').style.display = 'block';
                }
            });
        </script>
    </body>
@endsection
