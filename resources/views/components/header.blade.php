<header class="cs_site_header cs_style_1 cs_fs_18 cs_sticky_header">
      <div class="cs_main_header">
        <div class="cs_main_header_in">
          <div class="cs_main_header_left">
            <a class="cs_site_branding" href="{{ route('index') }}">
              <img src="{{ asset('assets/images/favicon.png') }}" alt="Logo">
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
                <li class="menu-item-has-children">
                  <a href="{{ route('destination') }}">Destinations</a>
                  {{-- <ul>
                    <li><a href="{{ route('destination') }}">Destination</a></li>
                    <li><a href="{{ route('destinationdetails') }}">Destination Details</a></li>
                  </ul> --}}
                </li>
                <li class="menu-item-has-children">
                  <a href="{{ route('tour') }}">Tours</a>
                  <ul>
                    <li><a href="{{ route('tour') }}">Tour</a></li>
                    <li><a href="{{ route('tourdetails') }}">Tour Details</a></li>
                  </ul>
                </li>
                <li class="menu-item-has-children">
                  <a href="{{ route('blog') }}">Blog</a>
                  <ul>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('blogdetails') }}">Blog Details</a></li>
                  </ul>
                </li>
                <li><a href="{{ route('contact') }}">Contacts</a></li>
              {{--  --}}
                    @auth
                    @if(Auth::user()->role_id == 2)
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                @endauth
                @if(Auth::check())
                    <li><a href="{{ route('profile', ['id' => Auth::user()->id]) }}">Profile</a></li>
                @endif


              </ul>
            </div>
          </div>
          <div class="cs_main_header_right">
            <div class="cs_header_toolbox">
              <div>
                <button class="cs_search_btn cs_fs_24" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
              </div>
              <div class="cs_fs_20 cs_medium">+8 (123) 985 789</div>
            </div>
          </div>
        </div>
      </div>
    </header>
