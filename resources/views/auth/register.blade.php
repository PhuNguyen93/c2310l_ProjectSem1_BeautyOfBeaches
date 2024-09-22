@extends('layouts.master-without-nav')
@section('title')
    {{ __('Register') }}
@endsection
@section('content')

<body class="flex items-center justify-center min-h-screen px-4 py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark dark:text-zink-100 font-public">

    <div class="mb-0 border-none shadow-none xl:w-2/3 card bg-white/70 dark:bg-zink-500/70">
        <div class="grid grid-cols-1 gap-0 lg:grid-cols-12">
            <div class="lg:col-span-5">
                <div class="!px-10 !py-12 card-body">

                    <div class="lg:w-[25rem] mx-auto">
                        <ul class="flex flex-wrap w-full gap-2 text-sm font-medium text-center nav-tabs">
                            <li class="group grow active">
                                <a href="javascript:void(0);" data-tab-toggle data-target="emailTabs" class="inline-block px-4 w-full py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 bg-slate-100 dark:text-zink-200 dark:bg-zink-600 border border-transparent group-[.active]:bg-custom-500 dark:group-[.active]:bg-custom-500 group-[.active]:text-white dark:group-[.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]"><i data-lucide="mail" class="inline-block size-4 mr-1"></i> <span class="align-middle">Email</span></a>
                            </li>
                            <li class="group grow">
                                <a href="javascript:void(0);" data-tab-toggle data-target="phoneTabs" class="inline-block px-4 w-full py-2 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 bg-slate-100 dark:text-zink-200 dark:bg-zink-600 border border-transparent group-[.active]:bg-custom-500 dark:group-[.active]:bg-custom-500 group-[.active]:text-white dark:group-[.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]"><i data-lucide="smartphone" class="inline-block size-4 mr-1"></i> <span class="align-middle">Phone</span></a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="mt-5 tab-content">
                            <div class="block tab-pane" id="emailTabs">
                                {{-- <form action="{{ route('register.store') }}" method="POST" class="mt-10" id="signInForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email-id-field" class="inline-block mb-2 text-base font-medium">Email</label>
                                        <input type="email" name="email" id="email-id-field" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter email" required>
                                        @error('email')
                                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="username-field" class="inline-block mb-2 text-base font-medium">UserName</label>
                                        <input type="text" name="name" id="username-field" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter username" required>
                                        @error('name')
                                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                                        <input type="password" name="password" id="password" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter password" required>
                                        @error('password')
                                            <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="inline-block mb-2 text-base font-medium">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Confirm password" required>
                                    </div>
                                    <p class="italic text-15 text-slate-500 dark:text-zink-200">By registering you agree to the Tailwick <a href="#!" class="underline">Terms of Use</a></p>
                                    <div class="mt-10">
                                        <button type="submit" class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Sign In</button>
                                    </div>
                                </form> --}}
                                <form method="POST" action="{{ route('register.store') }}">
                                    @csrf
                                    <input type="hidden" name="role_id" value="1">
                                    <div class="divider d-flex align-items-center my-4">
                                        <p class="text-center fw-bold mx-3 mb-0 text-dark">Register</p>
                                    </div>

                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <!-- Name input -->
                                    <div class="form-outline mb-4">
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Enter your name" value="{{ old('name') }}" required autofocus />
                                        <label class="form-label" for="name">Full Name</label>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter a valid email address" value="{{ old('email') }}" required />
                                        <label class="form-label" for="email">Email address</label>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <!-- Password input -->
                                    <div class="form-outline mb-3">
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter password" required />
                                        <label class="form-label" for="password">Password</label>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirm password" required />
                                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    </div>

                                    <!-- Driver License Number input -->


                                    <div class="text-center text-lg-start mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                                        <p class="small fw-bold mt-2 pt-1 mb-0 text-dark">Already have an account? <a href="{{ route('login') }}" class="link-danger">Login</a></p>
                                    </div>
                                </form>
                            </div>
                            <div class="hidden tab-pane" id="phoneTabs">
                                <form action="index.html" class="mt-10" id="signInForm">
                                    <div class="mb-3">
                                        <label for="phone-number-field" class="inline-block mb-2 text-base font-medium">Phone Number</label>
                                        <input type="number" id="phone-number-field" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter phone">
                                        <div id="phone-number-error" class="hidden mt-1 text-sm text-red-500">Please enter a valid phone number.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="username-field" class="inline-block mb-2 text-base font-medium">UserName</label>
                                        <input type="text" id="username-field" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter username">
                                        <div id="username-error" class="hidden mt-1 text-sm text-red-500">Please enter a username.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                                        <input type="password" id="password" class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter password">
                                        <div id="password-error" class="hidden mt-1 text-sm text-red-500">Password must be at least 8 characters long and contain both letters and numbers.</div>
                                    </div>
                                    <p class="italic text-15 text-slate-500 dark:text-zink-200">By registering you agree to the Tailwick <a href="#!" class="underline">Terms of Use</a></p>
                                    <div class="mt-10">
                                        <button type="submit" class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="relative text-center my-9 before:absolute before:top-3 before:left-0 before:right-0 before:border-t before:border-t-slate-200 dark:before:border-t-zink-500">
                            <h5 class="inline-block px-4 py-0.5 text-sm bg-white text-slate-500 dark:bg-zink-700 dark:text-zink-200 rounded relative">Create account with</h5>
                        </div>

                        <div class="flex flex-wrap justify-center gap-2">
                            <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 active:text-white active:bg-custom-600 active:border-custom-600"><i data-lucide="facebook" class="size-4"></i></button>
                            <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-orange-500 border-orange-500 hover:text-white hover:bg-orange-600 hover:border-orange-600 focus:text-white focus:bg-orange-600 focus:border-orange-600 active:text-white active:bg-orange-600 active:border-orange-600"><i data-lucide="mail" class="size-4"></i></button>
                            <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-sky-500 border-sky-500 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 active:text-white active:bg-sky-600 active:border-sky-600"><i data-lucide="twitter" class="size-4"></i></button>
                            <button type="button" class="flex items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 active:text-white active:bg-slate-600 active:border-slate-600"><i data-lucide="github" class="size-4"></i></button>
                        </div>

                        <div class="mt-10 text-center">
                            <p class="mb-0 text-slate-500 dark:text-zink-200">Already have an account ? <a href="{{ url('login') }}" class="font-semibold underline transition-all duration-150 ease-linear text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500">Login</a> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-2 mt-2 mb-2 border-none shadow-none lg:col-span-7 card bg-white/60 dark:bg-zink-500/60">
                <div class="!px-10 !pt-10 h-full !pb-0 card-body flex flex-col">
                    <div class="flex items-center justify-between gap-3">
                        <div class="grow">
                            <a href="index">
                                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" class="hidden h-6 dark:block">
                                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" class="block h-6 dark:hidden">
                            </a>
                        </div>
                        <div class="shrink-0">
                            <div class="relative dropdown text-end">
                                <button type="button" class="inline-flex items-center gap-3 transition-all duration-200 ease-linear dropdown-toggle btn border-slate-200 dark:border-zink-400/60 group/items focus:border-custom-500 dark:focus:border-custom-500" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                    <img src="{{ URL::asset('build/images/flags/us.svg') }}" alt="" class="object-cover h-5 rounded-full">
                                    <h6 class="text-base font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">English</h6>
                                </button>

                                <div class="absolute z-50 hidden p-3 mt-1 text-left list-none bg-white rounded-md shadow-md dropdown-menu min-w-[9rem] flex flex-col gap-3 dark:bg-zink-600" aria-labelledby="dropdownMenuButton">
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="{{ URL::asset('build/images/flags/us.svg') }}" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">English</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="{{ URL::asset('build/images/flags/es.svg') }}" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Spanish</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="{{ URL::asset('build/images/flags/de.svg') }}" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">German</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="{{ URL::asset('build/images/flags/fr.svg') }}" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">French</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="{{ URL::asset('build/images/flags/jp.svg') }}" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Japanese</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="{{ URL::asset('build/images/flags/it.svg') }}" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Italian</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="{{ URL::asset('build/images/flags/ru.svg') }}" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Russian</h6>
                                    </a>
                                    <a href="#!" class="flex items-center gap-3 group/items">
                                        <img src="{{ URL::asset('build/images/flags/ae.svg') }}" alt="" class="object-cover h-4 rounded-full">
                                        <h6 class="text-sm font-medium transition-all duration-200 ease-linear text-slate-600 group-hover/items:text-custom-500 dark:text-zink-200 dark:group-hover/items:text-custom-500">Arabic</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <img src="{{ URL::asset('build/images/auth/img-01.png') }}" alt="" class="md:max-w-[32rem] mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

