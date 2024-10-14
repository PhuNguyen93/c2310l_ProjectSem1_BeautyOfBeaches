@extends('layouts.master-without-nav')
@section('title')
    {{ __('Sign In') }}
@endsection
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <body
        class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">

        <div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70">
            <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
                <div class="lg:col-span-5">
                    <div class="!px-12 !py-12 card-body">
                        <div class="text-center">
                            <h4 class="mb-2 text-purple-500 dark:text-purple-500">Welcome </h4>
                            <p class="text-slate-500 dark:text-zink-200">Sign in to continue</p>
                        </div>


                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email input -->
                            <br>
                            <div class="mb-3">
                                <label for="username" class="inline-block mb-2 text-base font-medium">UserName/ Email
                                    ID</label>
                                <input type="text" id="username"
                                    class="form-input  dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter username or email" type="email" id="email" name="email"
                                    placeholder="Enter a valid email address" value="{{ old('email') }}" required
                                    autofocus>

                                {{-- @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <!-- Password input -->
                            <div class="mb-3">
                                <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                                <input type="password" id="password"
                                    class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                    placeholder="Enter password" type="password" id="password" name="password" required />
                                {{-- @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>
                            <!-- Remember -->
                            <div>
                                <div class="flex items-center gap-2">
                                    <input id="checkboxDefault1"
                                        class="size-4 border rounded-sm appearance-none bg-slate-100 border-slate-200 dark:bg-zink-600/50 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                        type="checkbox" value="">
                                    <label for="checkboxDefault1"
                                        class="inline-block text-base font-medium align-middle cursor-pointer">Remember
                                        me</label>
                                </div>



                                        <div class="relative dropdown text-end">
                                            <h6
                                                class="text-base font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">
                                                <a href="{{ route('forgot-password') }}" class="text-inherit">Forgot
                                                    Password?</a>
                                            </h6>
                                        </div>

                                    <div class="absolute z-50 hidden p-3 mt-1 text-left list-none bg-white rounded-md shadow-md dropdown-menu min-w-[9rem] flex flex-col gap-3 dark:bg-zink-600"
                                        aria-labelledby="dropdownMenuButton">
                                    </div>


                                <div class="hidden mt-1 text-sm text-red-500">Please check the "Remember
                                    me" before submitting the form.</div>
                            </div>
                            <!-- Sign IN -->
                            <div class="mt-10">
                                <button type="submit"
                                    class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Sign
                                    In</button>
                            </div>

                            <div
                                class="relative text-center my-9 before:absolute before:top-3 before:left-0 before:right-0 before:border-t before:border-t-slate-200 dark:before:border-t-zink-500">
                                <h5
                                    class="inline-block px-2 py-0.5 text-sm bg-white text-slate-500 dark:bg-zink-600 dark:text-zink-200 rounded relative">
                                    Sign In with</h5>
                            </div>
                            @if (session('success'))
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    Swal.fire({
                                        title: 'Success!',
                                        text: '{{ session('success') }}',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                </script>
                            @endif

                            @if (session('error'))
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    Swal.fire({
                                        title: 'Error!',
                                        text: '{{ session('error') }}',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                </script>
                            @endif
                            <div class="flex flex-wrap justify-center gap-2">
                                <button type="button"
                                    class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600"><i
                                        data-lucide="facebook" class="size-4"></i></button>
                                <button type="button"
                                    class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-orange-500 border-orange-500 hover:text-white hover:bg-orange-600 hover:border-orange-600 focus:text-white focus:bg-orange-600 focus:border-orange-600 active:text-white active:bg-orange-600 active:border-orange-600"><i
                                        data-lucide="mail" class="size-4"></i></button>
                                <button type="button"
                                    class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 active:text-white active:bg-sky-600 active:border-sky-600"><i
                                        data-lucide="twitter" class="size-4"></i></button>
                                <button type="button"
                                    class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 active:text-white active:bg-slate-600 active:border-slate-600"><i
                                        data-lucide="github" class="size-4"></i></button>
                            </div>

                            <div class="mt-10 text-center">
                                <p class="mb-0 text-slate-500 dark:text-zink-200">Don't have an account ? <a
                                        href="{{ url('register') }}"
                                        class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">
                                        SignUp</a> </p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mx-2 mt-2 mb-2 border-none shadow-none lg:col-span-7 card bg-white/60 dark:bg-zink-500/60">
                    <div class="!px-10 !pt-10 h-full !pb-0 card-body flex flex-col">
                        <div class="flex items-center justify-between gap-3">
                            <div class="grow">
                                <a href="index">
                                    <img src="{{ URL::asset('build/images/logo-light.png') }}" alt=""
                                        class="hidden h-6 dark:block">
                                    {{-- <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" class="block h-6 dark:hidden"> --}}
                                </a>
                            </div>

                        </div>
                        <div class="mt-auto">
                            <img src="{{ asset('images/beaches/1727789376.png') }}" alt="Beach Image"
                                class="md:max-w-[32rem] mx-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @push('scripts')
        <script src="{{ URL::asset('build/js/pages/auth-login.init.js') }}"></script>
    @endpush
