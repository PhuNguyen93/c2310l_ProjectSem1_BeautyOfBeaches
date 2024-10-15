@extends('layout.layout')

@section('content')

    <!-- Start Hero Section -->
    <x-hero subTitle='' img='assets/images/about-us-new.png' title='ABOUT US' />
    <!-- End Hero Section -->

    <!-- Start About Section -->
    <section class="cs_about cs_style_1 cs_ripple_activate">
      <div class="cs_height_140 cs_height_lg_80"></div>
      <div class="container">
        <div class="row align-items-center cs_gap_y_40 cs_mobile_reverse">
          <div class="col-lg-6">
            <div class="cs_section_heading cs_style_1">
              <h3 class="cs_section_title_up cs_ternary_font cs_accent_color cs_normal cs_fs_24">About Us</h3>
              <h2 class="cs_section_title cs_semibold cs_fs_56 mb-0">Welcome to Travel Top Destination of The World </h2>
            </div>
            <div class="cs_about_text">
                <p>Your gateway to discovering the most beautiful beaches and enjoying exceptional services. We take pride in offering unforgettable vacation experiences at the most pristine and enchanting coastal destinations. With a dedicated team, we are committed to providing the best information and services to help you plan your dream getaway. Let us be your guide as you explore nature and enjoy a perfect beach holiday!</p>
                <p class="mb-0 cs_accent_color cs_medium cs_fs_18">For inquiries or to book your perfect beach getaway, feel free to contact us at 07 1234 5678 – we’re here to help you every step of the way!</p>

            </div>
            <ul class="cs_list cs_style_1 cs_mp0 cs_fs_18">
                <li>
                    <i class="fa-solid fa-circle-check cs_accent_color"></i>
                    Discover paradise at the world’s most breathtaking beaches – your dream vacation awaits!
                </li>
                <li>
                    <i class="fa-solid fa-circle-check cs_accent_color"></i>
                   Unwind, relax, and let the waves carry your worries away with our tailored beach services.
                </li>
                <li>
                    <i class="fa-solid fa-circle-check cs_accent_color"></i>
                    Explore hidden gems and pristine shores, where luxury meets nature.
                </li>
                <li>
                    <i class="fa-solid fa-circle-check cs_accent_color"></i>
                    Book your unforgettable beach escape today and create memories that will last a lifetime!
                </li>
            </ul>
            <a href="" class="cs_btn cs_style_1 cs_fs_18 cs_medium">
              Read More
              <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.5866 5.69629H0.41235C0.184269 5.69629 0 5.46776 0 5.1849C0 4.90204 0.184269 4.67352 0.41235 4.67352H18.5906L16.0881 1.57004C15.927 1.37028 15.927 1.04587 16.0881 0.846109C16.2492 0.646349 16.5108 0.646349 16.6718 0.846109L19.8792 4.82374C19.9977 4.97076 20.0325 5.1897 19.9681 5.38147C19.9036 5.57164 19.7529 5.69629 19.5866 5.69629Z" fill="currentColor"/>
                <path d="M16.3435 9.11986C16.2384 9.11986 16.1333 9.08012 16.0538 8.99935C15.8935 8.83909 15.8935 8.57884 16.0538 8.41858L19.2487 5.22371C19.4089 5.06345 19.6692 5.06345 19.8294 5.22371C19.9897 5.38396 19.9897 5.64422 19.8294 5.80448L16.6346 8.99935C16.5538 9.08012 16.4487 9.11986 16.3435 9.11986Z" fill="currentColor"/>
              </svg>
            </a>
          </div>
          <div class="col-lg-5 offset-lg-1"><img src="assets/images/about-us.jpg" alt=""></div>
        </div>
      </div>
      <div class="cs_height_140 cs_height_lg_80"></div>
    </section>
    <!-- End About Section -->

    <!-- Start Banner Section -->
     <section class="cs_banner cs_style_2 cs_bg_filed cs_primary_bg" data-src="assets/images/bg_3.jpg">
      <div class="cs_height_115 cs_height_lg_80"></div>
      <div class="container">
        <div class="row align-items-center cs_gap_y_40">
          <div class="col-lg-6">
            {{-- <div class="cs_banner_thumb">
              <img src="assets/images/offer_text.png" alt="Offer Text">
            </div> --}}
          </div>
          <div class="col-lg-6">
            <div class="cs_banner_text cs_white_color">
              <h2 class="cs_banner_title cs_white_color cs_fs_50">Let Us Be the Pioneer</h2>
              <h3 class="cs_banner_title_mini cs_fs_20 cs_medium cs_white_color">"Your Experience, Our Pride."</h3>
              <p class="cs_banner_subtitle">we don’t just offer ordinary vacations; we are pioneers in discovering the most breathtaking and unique beach destinations. We strive to lead the way in providing high-quality travel services, with creativity and dedication in every detail. With our team of experienced experts, we’ll guide you on a journey to explore stunning beaches, delivering fresh, innovative, and unforgettable experiences. Let us be the one to open the door to pristine nature and the best vacations of your life!</p>
              <a href="#" class="cs_btn cs_style_1 cs_fs_18 cs_medium">
                Read More
                <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.5866 5.69629H0.41235C0.184269 5.69629 0 5.46776 0 5.1849C0 4.90204 0.184269 4.67352 0.41235 4.67352H18.5906L16.0881 1.57004C15.927 1.37028 15.927 1.04587 16.0881 0.846109C16.2492 0.646349 16.5108 0.646349 16.6718 0.846109L19.8792 4.82374C19.9977 4.97076 20.0325 5.1897 19.9681 5.38147C19.9036 5.57164 19.7529 5.69629 19.5866 5.69629Z" fill="currentColor"/>
                  <path d="M16.3435 9.11986C16.2384 9.11986 16.1333 9.08012 16.0538 8.99935C15.8935 8.83909 15.8935 8.57884 16.0538 8.41858L19.2487 5.22371C19.4089 5.06345 19.6692 5.06345 19.8294 5.22371C19.9897 5.38396 19.9897 5.64422 19.8294 5.80448L16.6346 8.99935C16.5538 9.08012 16.4487 9.11986 16.3435 9.11986Z" fill="currentColor"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="cs_height_120 cs_height_lg_80"></div>
     </section>
    <!-- End Banner Section -->

    <!-- Start Why Choose Us Section -->
    <section>
      <div class="cs_height_135 cs_height_lg_75"></div>
      <div class="container">
        <div class="cs_section_heading cs_style_1 text-center">
          <h3 class="cs_section_title_up cs_ternary_font cs_accent_color cs_normal cs_fs_24">Why Choose Us</h3>
          <h2 class="cs_section_title cs_semibold cs_fs_56 mb-0">Get The Best Travel Experience</h2>
        </div>
        <div class="cs_height_55 cs_height_lg_40"></div>
        <div class="cs_iconbox_4_wrap">
          <div>
            <div class="row cs_gap_y_45">
              <div class="col-lg-12 col-6">
                <div class="cs_iconbox cs_style_4">
                  <div class="cs_iconbox_icon cs_center">
                    <img src="assets/images/icons/calendar_icon_2.svg" alt="Calendar Icon">
                  </div>
                  <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Exclusive Destinations</h2>
                  <p class="cs_iconbox_subtitle mb-0">We offer access to some of the world’s most beautiful and serene beaches, ensuring you experience the perfect blend of luxury and nature.</p>
                </div>
              </div>
              <div class="col-lg-12 col-6">
                <div class="cs_iconbox cs_style_4">
                  <div class="cs_iconbox_icon cs_center">
                    <img src="assets/images/icons/hotel-icon.svg" alt="Hotel Icon">
                  </div>
                  <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Expert Guidance</h2>
                  <p class="cs_iconbox_subtitle mb-0">With our team of knowledgeable experts, we make planning easy and stress-free, ensuring every detail of your vacation is taken care of.</p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="cs_iconbox_4_thumb cs_center">
              <img src="assets/images/bestexperiences.jpg" alt="About Thumb">
            </div>
          </div>
          <div>
            <div class="row cs_gap_y_45">
              <div class="col-lg-12 col-6">
                <div class="cs_iconbox cs_style_4">
                  <div class="cs_iconbox_icon cs_center">
                    <img src="assets/images/icons/compass_icon.svg" alt="Calendar Icon">
                  </div>
                  <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Safety and Convenience</h2>
                  <p class="cs_iconbox_subtitle mb-0">We prioritize your safety and comfort, offering secure, hassle-free bookings and reliable support throughout your entire beach journey.</p>
                </div>
              </div>
              <div class="col-lg-12 col-6">
                <div class="cs_iconbox cs_style_4">
                  <div class="cs_iconbox_icon cs_center">
                    <img src="assets/images/icons/headset_icon.svg" alt="Hotel Icon">
                  </div>
                  <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Personalized Services</h2>
                  <p class="cs_iconbox_subtitle mb-0">Our services are tailored to meet your individual needs, providing you with a customized beach getaway that exceeds expectations.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cs_height_135 cs_height_lg_75"></div>
    </section>
    <!-- End Why Choose Us Section -->

   <!-- Start Team Section -->
<section class="cs_accent_bg_1">
  <div class="cs_height_135 cs_height_lg_75"></div>
  <div class="container">
      <div class="cs_section_heading cs_style_1 text-center">
          <h3 class="cs_section_title_up cs_ternary_font cs_accent_color cs_normal cs_fs_24">About Us</h3>
          <h2 class="cs_section_title cs_semibold cs_fs_56 mb-0">Our Team Member</h2>
      </div>
      <div class="cs_height_55 cs_height_lg_40"></div>
      <div class="row cs_gap_y_24">
          <!-- Team Member 1 -->
          <div class="col-lg-4">
              <div class="cs_team cs_style_1 position-relative">
                  <div class="cs_team_thumb cs_zoom overflow-hidden">
                      <img src="assets/images/trangiabao.jpg" alt="Team Thumb" >
                  </div>
                  <div class="cs_team_info text-center position-absolute">
                      <h2 class="cs_team_title cs_fs_24 cs_medium cs_white_color">Trần Gia Bảo</h2>
                      <p class="cs_team_subtitle cs_white_color">Developer</p>
                      <div class="cs_social_btns">
                          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                          <a href="#"><i class="fa-brands fa-twitter"></i></a>
                          <a href="#"><i class="fa-brands fa-instagram"></i></a>
                          <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Team Member 2 -->
          <div class="col-lg-4">
              <div class="cs_team cs_style_1 position-relative">
                  <div class="cs_team_thumb cs_zoom overflow-hidden">
                      <img src="assets/images/nguyenminhphu.png" alt="Team Thumb" >
                  </div>
                  <div class="cs_team_info text-center position-absolute">
                      <h2 class="cs_team_title cs_fs_24 cs_medium cs_white_color">Nguyễn Minh Phú</h2>
                      <p class="cs_team_subtitle cs_white_color">Developer</p>
                      <div class="cs_social_btns">
                          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                          <a href="#"><i class="fa-brands fa-twitter"></i></a>
                          <a href="#"><i class="fa-brands fa-instagram"></i></a>
                          <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Team Member 3 -->
          <div class="col-lg-4">
              <div class="cs_team cs_style_1 position-relative">
                  <div class="cs_team_thumb cs_zoom overflow-hidden">
                      <img src="assets/images/lamxuanhung.jpg" alt="Team Thumb" >
                  </div>
                  <div class="cs_team_info text-center position-absolute">
                      <h2 class="cs_team_title cs_fs_24 cs_medium cs_white_color">Lâm Xuân Hùng</h2>
                      <p class="cs_team_subtitle cs_white_color">Developer</p>
                      <div class="cs_social_btns">
                          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                          <a href="#"><i class="fa-brands fa-twitter"></i></a>
                          <a href="#"><i class="fa-brands fa-instagram"></i></a>
                          <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Team Member 4 -->
          <div class="col-lg-4 offset-lg-2">
            <div class="cs_team cs_style_1 position-relative">
                <div class="cs_team_thumb cs_zoom overflow-hidden">
                    <img src="assets/images/nguyenvietduc.png" alt="Team Thumb" >
                </div>
                <div class="cs_team_info text-center position-absolute">
                    <h2 class="cs_team_title cs_fs_24 cs_medium cs_white_color">Nguyễn Việt Đức</h2>
                    <p class="cs_team_subtitle cs_white_color">PO & Tester</p>
                    <div class="cs_social_btns">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Member 5 -->
        <div class="col-lg-4">
          <div class="cs_team cs_style_1 position-relative">
              <div class="cs_team_thumb cs_zoom overflow-hidden">
                  <img src="assets/images/dangbaan.png" alt="Team Thumb">
              </div>
              <div class="cs_team_info text-center position-absolute">
                  <h2 class="cs_team_title cs_fs_24 cs_medium cs_white_color">Đặng Bá An</h2>
                  <p class="cs_team_subtitle cs_white_color">Developer</p>
                  <div class="cs_social_btns">
                      <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                      <a href="#"><i class="fa-brands fa-twitter"></i></a>
                      <a href="#"><i class="fa-brands fa-instagram"></i></a>
                      <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                  </div>
              </div>
          </div>
      </div>

      </div>
  </div>


  <div class="cs_height_140 cs_height_lg_80" ></div>
  <style>
    .cs_team_thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
  </style>
</section>
<!-- End Team Section -->



    <!-- Start Video Section -->
    {{-- <section>
      <div class="cs_height_140 cs_height_lg_80"></div>
      <div class="container">
        <div class="cs_video_block cs_style_1 cs_bg_filed position-relative" data-src="assets/images/video_block.jpeg">
          <a href="https://www.youtube.com/embed/eSUmkFPln_U" class="cs_player_btn cs_center cs_accent_bg cs_video_open">
            <svg width="40" height="47" viewBox="0 0 40 47" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M36.9921 17.8114L9.63992 0.951019C7.66105 -0.267256 5.26855 -0.317908 3.23984 0.815524C1.21113 1.94878 0 4.01294 0 6.3367V39.9039C0 43.4175 2.83109 46.2914 6.31071 46.3104C6.32021 46.3104 6.32971 46.3105 6.33902 46.3105C7.42642 46.3104 8.55958 45.9696 9.61794 45.3238C10.4693 44.8043 10.7384 43.693 10.219 42.8417C9.69952 41.9902 8.58807 41.7212 7.73693 42.2407C7.2419 42.5426 6.75844 42.6988 6.33016 42.6987C5.01727 42.6916 3.61159 41.5669 3.61159 39.904V6.33679C3.61159 5.33994 4.13113 4.4547 5.00127 3.96853C5.87149 3.48236 6.89764 3.50407 7.74543 4.02606L35.0977 20.8864C35.9198 21.3926 36.3902 22.2366 36.3882 23.2021C36.3862 24.1674 35.9124 25.0095 35.0857 25.514L15.31 37.6224C14.4594 38.1432 14.192 39.2549 14.7128 40.1054C15.2335 40.956 16.3453 41.2234 17.1959 40.7026L36.9693 28.5956C38.8625 27.4407 39.9955 25.4272 40 23.2093C40.0045 20.9916 38.8797 18.9735 36.9921 17.8114Z" fill="currentColor" />
            </svg>
          </a>
          <h2 class="cs_video_title cs_fs_60 cs_semibold cs_white_color position-absolute mb-0">Our Journey <br> in Videos</h2>
          <span class="cs_location cs_fs_20 cs_white_color">
            <i class="fa-solid fa-location-dot"></i> Location Mountain Strait, Any State</span>
        </div>
      </div>
    </section> --}}
    <!-- End Video Section -->

    <!-- Start Brands Section -->
    <div>
      <div class="cs_height_76 cs_height_lg_40"  ></div>
      <div class="container">
        <div class="cs_brand_list cs_style_1" data-src="assets/images/sey7.jpg">
          {{-- <div class="cs_brand"><img src="assets/images/brand_1.svg" alt="Brand"></div>
          <div class="cs_brand"><img src="assets/images/brand_2.svg" alt="Brand"></div>
          <div class="cs_brand"><img src="assets/images/brand_3.svg" alt="Brand"></div>
          <div class="cs_brand"><img src="assets/images/brand_4.svg" alt="Brand"></div>
          <div class="cs_brand"><img src="assets/images/brand_5.svg" alt="Brand"></div> --}}
        </div>
      </div>
      <div class="cs_height_135 cs_height_lg_80" ></div>
    </div>
    <!-- End Brands Section -->
  @endsection
