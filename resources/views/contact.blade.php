@extends('layout.layout')

@section('content')
    <!-- Start Hero Section -->
    <x-hero subTitle='Modern & Beautiful Travel Theme' img='assets/images/beach.jpg' title='Contact Us' />
    <!-- End Hero Section -->

    <!-- Start Contact Section -->
    <section>
        <div class="cs_height_140 cs_height_lg_80"></div>
        <div class="container">
            <div class="row cs_gap_y_40">
                <div class="col-lg-3 col-md-6">
                    <div class="cs_iconbox cs_style_5 cs_gray_bg cs_radius_5 text-center">
                        <div class="cs_iconbox_icon cs_accent_bg cs_white_color cs_center cs_radius_5"><i
                                class="fa-solid fa-location-dot"></i></div>
                        <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Office Address</h2>
                        <p class="cs_iconbox_subtitle mb-0">35/6 Đường D5, Phường 25, Bình Thạnh, Hồ Chí Minh 72308, Việt Nam</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="cs_iconbox cs_style_5 cs_gray_bg cs_radius_5 text-center">
                        <div class="cs_iconbox_icon cs_accent_bg cs_white_color cs_center cs_radius_5"><i
                                class="fa-solid fa-phone"></i></div>
                        <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Phone Call</h2>
                        <p class="cs_iconbox_subtitle mb-0">036 7777 747 <br>036 7777 747</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="cs_iconbox cs_style_5 cs_gray_bg cs_radius_5 text-center">
                        <div class="cs_iconbox_icon cs_accent_bg cs_white_color cs_center cs_radius_5"><i
                                class="fa-solid fa-envelope"></i></div>
                        <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">E-Mail Us</h2>
                        <p class="cs_iconbox_subtitle mb-0">example@gmail.com <br> yourmail@gmail.com</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="cs_iconbox cs_style_5 cs_gray_bg cs_radius_5 text-center">
                        <div class="cs_iconbox_icon cs_accent_bg cs_white_color cs_center cs_radius_5"><i
                                class="fa-solid fa-headset"></i></div>
                        <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Supports</h2>
                        <p class="cs_iconbox_subtitle mb-0">24/7 any time support team <br> ready for supports.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="cs_height_140 cs_height_lg_80"></div>
    </section>
    <!-- End Contact Section -->

    <!-- Start Contact Form Section -->
    <section class="cs_gray_bg">
        <div class="cs_height_135 cs_height_lg_75"></div>
        <div class="container">
            <div class="cs_section_heading cs_style_1 text-center">
                <h3 class="cs_section_title_up cs_ternary_font cs_accent_color cs_normal cs_fs_24">CONTACT US</h3>
                <h2 class="cs_section_title cs_semibold cs_fs_56 mb-0">Contact Information</h2>
            </div>
            <div class="cs_height_55 cs_height_lg_40"></div>
            <form class="cs_contact_form row cs_gap_y_24">
                <div class="col-lg-6">
                    <div class="cs_input_field">
                        <input type="text" placeholder="Enter Your Name" class="cs_form_field cs_radius_5">
                        <span><i class="fa-regular fa-user"></i></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cs_input_field">
                        <input class="cs_form_field cs_radius_5 cs_white_bg" type="email" placeholder="Enter Your E-Mail">
                        <span><i class="fa-regular fa-envelope"></i></span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <input class="cs_form_field cs_radius_5 cs_white_bg" type="text" placeholder="Select Subjects">
                </div>
                <div class="col-lg-12">
                    <textarea rows="5" class="cs_form_field cs_radius_5 cs_white_bg" placeholder="Write Message..."></textarea>
                </div>
                <div class="col-lg-12 text-center">
                    <button type="submit" class="cs_btn cs_style_1 cs_fs_18 cs_medium cs_radius_4"><i
                            class="fa-regular fa-envelope"></i> Send Message</button>
                </div>
            </form>
        </div>
        <div class="cs_height_100 cs_height_lg_60"></div>
    </section>
    <!-- End Contact Form Section -->

    <!-- Start Location Section -->
    <div class="cs_google_map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.060333615078!2d106.70932368225814!3d10.80669113117833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529ed00409f09%3A0x11f7708a5c77d777!2zQXB0ZWNoIENvbXB1dGVyIEVkdWNhdGlvbiAtIEjhu4cgVGjhu5FuZyDEkMOgbyB04bqhbyBM4bqtcCBUcsOsbmggVmnDqm4gUXXhu5FjIHThur8gQXB0ZWNo!5e0!3m2!1svi!2s!4v1727100822539!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- End Location Section -->
@endsection
