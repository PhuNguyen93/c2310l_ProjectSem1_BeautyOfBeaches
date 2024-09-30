<header class="cs_site_header cs_style_1 cs_fs_18 cs_sticky_header">
    <div class="cs_main_header">
        <div class="cs_main_header_in">
        <div class="cs_main_header_left">
    <a class="cs_site_branding" href="{{ route('index') }}">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="64" height="64" style="object-fit: contain;">
    </a>
</div>
            <div class="cs_main_header_center">
                <div class="cs_nav cs_medium cs_primary_font">
                    <ul class="cs_nav_list">
                        <li class="menu-item-has-children">
                            <a href="{{ route('index') }}">Home</a>
                            {{-- <ul>
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('index2') }}">Home v2</a></li>
                    <li><a href="{{ route('index3') }}">Home v3</a></li>
                  </ul> --}}
                        </li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li>
                            <a href="{{ route('destination') }}">Destinations</a>
                            {{-- <ul>
                    <li><a href="{{ route('destination') }}">Destination</a></li>
                    <li><a href="{{ route('destinationdetails') }}">Destination Details</a></li>
                  </ul> --}}
                        </li>
                        <li>
                            <a href="{{ route('tour') }}">Tours</a>
                            <ul>
                                <li><a href="{{ route('tour') }}">Tour</a></li>
                                <li><a href="{{ route('tourdetails') }}">Tour Details</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('blog') }}">Blog</a>
                            <ul>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                <li><a href="{{ route('blogdetails') }}">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('contact') }}">Contacts</a></li>
                        {{--  --}}
                        @auth
                            <!-- Nếu người dùng là admin (role_id == 2), hiển thị Dashboard -->
                            @if (Auth::user()->role_id == 2)
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            @endif

                            <!-- Nếu người dùng là user (role_id == 1), hiển thị Profile -->
                            @if (Auth::user()->role_id == 1)
                                <li><a href="{{ route('profile', ['id' => Auth::user()->id]) }}">Profile</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="cs_main_header_right">
                <div class="cs_header_toolbox">
                    <div>
                        <button class="cs_search_btn cs_fs_24" type="button"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <div class="cs_header_buttons">
                        @if (Auth::check())
                            <!-- Hiển thị khi người dùng đã đăng nhập -->
                            <span class="cs_welcome_text">Welcome, {{ Auth::user()->name }}!</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-info m-2">Logout</button>
                            </form>
                        @else
                            <!-- Hiển thị nút Login và Sign Up khi người dùng chưa đăng nhập -->
                            <a href="{{ route('login') }}" class="cs_btn cs_style_1 me-2">Login</a>
                            <a href="{{ route('register') }}" class="cs_btn cs_style_1">Sign Up</a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
