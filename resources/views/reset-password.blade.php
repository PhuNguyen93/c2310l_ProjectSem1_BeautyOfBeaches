@extends('layouts.master-without-nav')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')

<body class="flex items-center justify-center min-h-screen py-16 lg:py-10 bg-slate-50 dark:bg-zink-800 dark:text-zink-100 font-public">
    <div class="relative">
        <div class="absolute hidden opacity-50 ltr:-left-16 rtl:-right-16 -top-10 md:block">
            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 125 316" width="125" height="316">
                <title>&lt;Group&gt;</title>
                <g id="&lt;Group&gt;">
                    <path id="&lt;Path&gt;" class="fill-custom-100/50 dark:fill-custom-950/50" d="m23.4 221.8l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-100 dark:fill-custom-950" d="m31.2 229.6l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/50 dark:fill-custom-900/50" d="m39 237.4l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200/75 dark:fill-custom-900/75" d="m46.8 245.2l-1.3-3.1v-315.3l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-200 dark:fill-custom-900" d="m54.6 253.1l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/50 dark:fill-custom-800/50" d="m62.4 260.9l-1.2-3.1v-315.4l1.2 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300/75 dark:fill-custom-800/75" d="m70.3 268.7l-1.3-3.1v-315.4l1.3 3.1z" />
                    <path id="&lt;Path&gt;" class="fill-custom-300 dark:fill-custom-800" d="m78.1 276.5l-1.3-3.1v-315.3l1.3 3.1z" />
                </g>
            </svg>
        </div>

        <div class="mb-0 w-screen lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
            <div class="!px-10 !py-12 card-body">
                <a href="#!">
                    <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" class="hidden h-6 mx-auto dark:block">
                    <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" class="block h-6 mx-auto dark:hidden">
                </a>

                <div class="mt-8 text-center">
                    <h4 class="mb-2 text-custom-500 dark:text-custom-500">Reset Your Password</h4>
                    <p class="mb-8 text-slate-500 dark:text-zink-200">Enter a new password to reset your account</p>
                </div>

                <!-- Form để nhập mật khẩu mới -->
                <form method="POST" action="{{ route('reset.password') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-4">
                        <label for="new_password" class="inline-block mb-2 text-base font-medium">New Password</label>
                        <input type="password" name="new_password" id="new_password"
                               class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                               required placeholder="Enter new password">
                    </div>

                    <div class="mb-4">
                        <label for="confirm_password" class="inline-block mb-2 text-base font-medium">Confirm New Password</label>
                        <input type="password" name="confirm_password" id="confirm_password"
                               class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                               required placeholder="Confirm new password">
                    </div>

                    <!-- Nút Confirm để đặt lại mật khẩu -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-full">
                            Confirm
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
