@extends('layouts.master')
@section('title')
    {{ __('Account') }}
@endsection
@section('content')
<style>

    .avatar-container {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto; /* Center horizontally */
    }

    /* Avatar image styling */
    .avatar-image {
        width: 100%; /* Full width of the container */
        height: 100%; /* Full height of the container */
        object-fit: cover; /* Maintain aspect ratio and cover the container */
        border-radius: 50%; /* Make the image round */
        border: 2px solid #e5e7eb; /* Optional border */
    }

    /* Icon wrapper for edit icon */
    .edit-icon-wrapper {
        width: 40px;
        height: 40px;
        background-color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Icon styling */
    .edit-icon {
        width: 40px;
        height: 40px;
        background-color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e5e7eb;
    }

    .icon-size-4 {
        font-size: 1.5rem; /* Adjust size of the icon */
    }


</style>
    <div class="mt-1 -ml-3 -mr-3 rounded-none card">
        <div class="card-body !px-2.5">
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-12 2xl:grid-cols-12">
                <div class="lg:col-span-2 2xl:col-span-1">
                    <form action="{{ route('profile.upload_avatar') }}" method="POST" enctype="multipart/form-data" id="UpdateAvatar" >
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="lg:col-span-2 2xl:col-span-1">
                            <div class="relative inline-block size-20 rounded-full shadow-md bg-slate-100 profile-user xl:size-28">
                               <img src="{{ asset($user->img ) }}" alt="Avatar" alt=""
                                    class="object-cover border-0 rounded-full img-thumbnail user-profile-image avatar-image rounded-full object-cover border-2 border-gray-200">
                                <div
                                    class="absolute bottom-0 flex items-center justify-center size-8 rounded-full ltr:right-0 rtl:left-0 profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" name="avatar" class="hidden profile-img-file-input" accept="image/*" required  >
                                    <label for="profile-img-file-input"
                                        class="flex items-center justify-center size-8 bg-white rounded-full shadow-lg cursor-pointer dark:bg-zink-600 profile-photo-edit">
                                        <i data-lucide="image-plus"
                                            class="size-4 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </form>
                    <script>
                         document.addEventListener('DOMContentLoaded', function () {
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
                </div><!--end col-->
                <div class="lg:col-span-10 2xl:col-span-9">
                    <h5 class="mb-1">{{ $user->name }} <i data-lucide="badge-check"
                        class="inline-block size-4 text-sky-500 fill-sky-100 dark:fill-custom-500/20"></i></h5>
                <div class="flex gap-3 mb-4">
                    <p class="text-slate-500 dark:text-zink-200"><i data-lucide="map-pin"
                            class="inline-block size-4 ltr:mr-1 rtl:ml-1 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-500"></i>
                        {{ $user->country }}</p>
                </div>

                    {{-- <p class="mt-4 text-slate-500 dark:text-zink-200">Strong leader and negotiator adept at driving
                        collaboration and innovation. Highly accomplished CEO & Founder with 10+ years of experience
                        creating, launching and leading successful business ventures. Proven ability to build relationships,
                        drive customer loyalty and increase profitability.</p> --}}
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
                                        href="#!">Genarate Bill</a>
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
        {{-- <div class="card-body !px-2.5 !py-0">
            <ul class="flex flex-wrap w-full text-sm font-medium text-center nav-tabs">
                <li class="group active">
                    <a href="javascript:void(0);" data-tab-toggle data-target="overviewTabs"
                        class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 dark:group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">Overview</a>
                </li>
                <li class="group">
                    <a href="javascript:void(0);" data-tab-toggle data-target="documentsTabs"
                        class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 dark:group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]"></a>
                </li>
                <li class="group">
                    <a href="javascript:void(0);" data-tab-toggle data-target="projectsTabs"
                        class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 dark:group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">Projects</a>
                </li>
                <li class="group">
                    <a href="javascript:void(0);" data-tab-toggle data-target="followersTabs"
                        class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border-b border-transparent group-[.active]:text-custom-500 dark:group-[.active]:text-custom-500 group-[.active]:border-b-custom-500 dark:group-[.active]:border-b-custom-500 hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]">Followers</a>
                </li>
            </ul>
        </div> --}}
    </div><

    <div class="tab-content">
        <div class="block tab-pane" id="overviewTabs">
            <div class="grid grid-cols-1 gap-x-5 2xl:grid-cols-12">
                <div class="2xl:col-span-9">

                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3 text-15">Overview</h6>
                            <p class="mb-2 text-slate-500 dark:text-zink-200">A Web Developer creates and designs different
                                websites for clients. They are responsible for their aesthetic as well as their function.
                                Professionals in this field may also need to be able to ensure sites are compatible with
                                multiple types of media. Web Developers need to have a firm understanding of programming and
                                graphical design. Having a strong resume that emphasizes these attributes makes it
                                significantly easier to get hired as a Web Developer.</p>
                            <p class="text-slate-500 dark:text-zink-200">As a web designer, my objective is to make a
                                positive impact on clients, co-workers, and the Internet using my skills and experience to
                                design compelling and attractive websites. Solving code problems. Editing & Design with
                                designing team in the company to build perfect web designs.</p>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="2xl:col-span-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-15">Personal Information</h6>
                            <div class="overflow-x-auto">
                                <table class="w-full ltr:text-left rtl:ext-right">
                                    <tbody>
                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">Phone </th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">{{ $user->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">Birth of Date</th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">{{ $user->birth_date }}</td>
                                        </tr>
                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">Email</th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="py-2 font-semibold ps-0" scope="row">Location</th>
                                            <td class="py-2 text-right text-slate-500 dark:text-zink-200">{{ $user->country }}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-2 font-semibold ps-0" scope="row">Joining Date</th>
                                            <td class="pt-2 text-right text-slate-500 dark:text-zink-200">{{ $user->created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div><!--end card-->

                </div><!--end col-->
            </div><!--end grid-->

        </div><!--end tab pane-->





        <div class="hidden tab-pane" id="followersTabs">


            {{-- <div class="flex flex-col items-center gap-4 mb-4 md:flex-row">
                <div class="grow">
                    <p class="text-slate-500 dark:text-zink-200">Showing <b>8</b> of <b>18</b> Results</p>
                </div>
                <ul class="flex flex-wrap items-center gap-2">
                    <li>
                        <a href="#!"
                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 size-8 transition-all duration-150 ease-linear border border-slate-200 dark:border-zink-500 rounded text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-50 dark:[&.active]:text-custom-50 [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto"><i
                                class="size-4 rtl:rotate-180" data-lucide="chevron-left"></i></a>
                    </li>
                    <li>
                        <a href="#!"
                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 size-8 transition-all duration-150 ease-linear border border-slate-200 dark:border-zink-500 rounded text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-50 dark:[&.active]:text-custom-50 [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">1</a>
                    </li>
                    <li>
                        <a href="#!"
                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 size-8 transition-all duration-150 ease-linear border border-slate-200 dark:border-zink-500 rounded text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-50 dark:[&.active]:text-custom-50 [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">2</a>
                    </li>
                    <li>
                        <a href="#!"
                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 size-8 transition-all duration-150 ease-linear border border-slate-200 dark:border-zink-500 rounded text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-50 dark:[&.active]:text-custom-50 [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto active">3</a>
                    </li>
                    <li>
                        <a href="#!"
                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 size-8 transition-all duration-150 ease-linear border border-slate-200 dark:border-zink-500 rounded text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-50 dark:[&.active]:text-custom-50 [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">4</a>
                    </li>
                    <li>
                        <a href="#!"
                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 size-8 transition-all duration-150 ease-linear border border-slate-200 dark:border-zink-500 rounded text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-50 dark:[&.active]:text-custom-50 [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">5</a>
                    </li>
                    <li>
                        <a href="#!"
                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 size-8 transition-all duration-150 ease-linear border border-slate-200 dark:border-zink-500 rounded text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-50 dark:[&.active]:text-custom-50 [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">6</a>
                    </li>
                    <li>
                        <a href="#!"
                            class="inline-flex items-center justify-center bg-white dark:bg-zink-700 size-8 transition-all duration-150 ease-linear border border-slate-200 dark:border-zink-500 rounded text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-50 dark:[&.active]:text-custom-50 [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto"><i
                                class="size-4 rtl:rotate-180" data-lucide="chevron-right"></i></a>
                    </li>
                </ul>
            </div> --}}
        </div><!--end tab pane-->
    </div>
    <div class="mt-5 w-full overflow-x-auto">
        <div class="card-body w-full">
            <h4 class="mb-3 font-semibold text-xl">All Comments on Beaches</h4>

            <!-- Form lọc theo số sao -->
            <form method="GET" action="{{ route('user.filterFeedback', ['id' => $user->id]) }}" class="mb-4">
                <label for="ratingFilter" class="mr-2">Filter by Rating:</label>
                <select name="rating" id="ratingFilter" class="border px-2 py-1">
                    <option value="">All Ratings</option>
                    <option value="5" {{ request('rating') == 5 ? 'selected' : '' }}>5 Stars</option>
                    <option value="4" {{ request('rating') == 4 ? 'selected' : '' }}>4 Stars</option>
                    <option value="3" {{ request('rating') == 3 ? 'selected' : '' }}>3 Stars</option>
                    <option value="2" {{ request('rating') == 2 ? 'selected' : '' }}>2 Stars</option>
                    <option value="1" {{ request('rating') == 1 ? 'selected' : '' }}>1 Star</option>
                </select>
                <button type="submit" class="btn bg-custom-500 text-white">
                    Filter
                </button>
            </form>

            @if($feedbacks->isEmpty())
                <p class="text-gray-500">No comments yet.</p>
            @else
                <table class="min-w-full w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Avatar</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Country</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Rating</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Comment</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Creation Date</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                        <tr class="bg-white border-b">
                            <!-- Beach Image -->
                            <td class="px-6 py-4">
                                <img src="{{ asset($feedback->beach->image_url) }}" alt="Beach Image"
                                    class="w-12 h-12 rounded-full object-cover">
                            </td>

                            <!-- Beach Name -->
                            <td class="px-6 py-4 text-gray-700">{{ $feedback->beach->name }}</td>

                            <!-- Country -->
                            <td class="px-6 py-4 text-gray-700">{{ $feedback->beach->country }}</td>

                            <!-- Rating -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $feedback->rating)
                                            <span class="text-yellow-400">★</span>
                                        @else
                                            <span class="text-gray-300">★</span>
                                        @endif
                                    @endfor
                                </div>
                            </td>

                            <!-- Comment -->
                            <td class="px-6 py-4 text-gray-700">{{ $feedback->message }}</td>

                            <!-- Creation Date -->
                            <td class="px-6 py-4 text-gray-500">{{ $feedback->created_at->format('Y-m-d H:i:s') }}</td>

                            <!-- Action -->
                            <td class="px-6 py-4">
                                <button class="bg-gray-200 text-gray-600 px-2 py-1 rounded">...</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $feedbacks->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>







@endsection
@push('scripts')
    <!-- apexcharts js -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/pages-account.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endpush
