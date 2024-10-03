@extends('layouts.master-without-nav')
@section('title')
    {{ __('Sign In') }}
@endsection
@section('content')

<body class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">

    <div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70">
        <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
            <!-- Left Side: Login Form -->
            <div class="lg:col-span-6">
                <div class="!px-12 !py-12 card-body">
                    <div class="text-center">
                        <h4 class="mb-2 text-purple-500 dark:text-purple-500">Welcome Back !</h4>
                        <p class="text-slate-500 dark:text-zink-200">Sign in to continue to Tailwick.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email input -->
                        <br>
                        <div class="mb-3">
                            <label for="username" class="inline-block mb-2 text-base font-medium">UserName/ Email ID</label>
                            <input type="text" id="username"
                                class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter username or email" name="email" value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="mb-3">
                            <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                            <input type="password" id="password"
                                class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Enter password" name="password" required />
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Remember me -->
                        <div>
                            <div class="flex items-center gap-2">
                                <input id="checkboxDefault1"
                                    class="size-4 border rounded-sm appearance-none bg-slate-100 border-slate-200 dark:bg-zink-600/50 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500"
                                    type="checkbox" name="remember">
                                <label for="checkboxDefault1" class="inline-block text-base font-medium align-middle cursor-pointer">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <!-- Sign In -->
                        <div class="mt-10">
                            <button type="submit"
                                class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                Sign In
                            </button>
                        </div>

                        <div class="relative text-center my-9 before:absolute before:top-3 before:left-0 before:right-0 before:border-t before:border-t-slate-200 dark:before:border-t-zink-500">
                            <h5 class="inline-block px-2 py-0.5 text-sm bg-white text-slate-500 dark:bg-zink-600 dark:text-zink-200 rounded relative">
                                Sign In with
                            </h5>
                        </div>

                        <div class="flex flex-wrap justify-center gap-2">
                            <button type="button" class="btn bg-custom-500"><i data-lucide="facebook"></i></button>
                            <button type="button" class="btn bg-orange-500"><i data-lucide="mail"></i></button>
                            <button type="button" class="btn bg-sky-500"><i data-lucide="twitter"></i></button>
                            <button type="button" class="btn bg-slate-500"><i data-lucide="github"></i></button>
                        </div>

                        <div class="mt-10 text-center">
                            <p class="mb-0 text-slate-500 dark:text-zink-200">Don't have an account?
                                <a href="{{ url('register') }}" class="font-semibold underline">SignUp</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Right Side: Forgot Password and OTP -->
            <div class="lg:col-span-6">
                <div class="!px-12 !py-12 card-body">
                    <!-- Forgot Password Button -->
                    <div class="shrink-0 mt-5">
                        <button type="button" id="forgot-password-button"
                            class="inline-flex items-center gap-3 btn text-slate-600 group-hover/items:text-custom-500">
                            <h6 class="text-base font-medium">Forgot Password?</h6>
                        </button>
                    </div>

                    <!-- Input OTP Email (Hidden initially) -->
                    <div id="forgot-password-input" class="{{ session('otp_sent') ? '' : 'hidden' }} mt-4">
                        <form method="POST" action="{{ route('sendOtpForReset') }}">
                            @csrf
                            <label for="reset_email" class="inline-block mb-2 text-base font-medium">Enter your email:</label>
                            <input type="email" id="reset_email" name="email"
                                class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500"
                                placeholder="Enter your email" value="{{ session('email') }}" required>
                            <button type="submit" class="mt-4 btn bg-custom-500 text-white">Send OTP</button>
                        </form>
                    </div>

                    <!-- OTP Verification (Displayed after OTP is sent) -->
                    @if (session('otp_sent'))
                        <div id="otp-verification" class="mt-4">
                            <form method="POST" action="{{ route('verifyResetOtp') }}">
                                @csrf
                                <label for="otp" class="inline-block mb-2 text-base font-medium">Enter OTP:</label>
                                <input type="text" id="otp" name="otp" class="form-input"
                                    placeholder="Enter OTP" required>
                                <input type="hidden" name="email" value="{{ session('email') }}">
                                <button type="submit" class="mt-4 btn bg-custom-500 text-white">Verify OTP</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('forgot-password-button').addEventListener('click', function () {
                var inputField = document.getElementById('forgot-password-input');
                if (inputField.classList.contains('hidden')) {
                    inputField.classList.remove('hidden');
                } else {
                    inputField.classList.add('hidden');
                }
            });
        </script>
    @endpush
@endsection
