@extends('layout.layout')

@section('content')
    <!-- Start Hero Section -->
    <section class="cs_hero cs_style_1 cs_center cs_ripple_activate cs_primary_bg"
        style="background-image: url('https://plus.unsplash.com/premium_photo-1669748157617-a3a83cc8ea23?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') ">
        <div class="container">
            <div class="cs_hero_text text-center">
                <h1 class="cs_hero_title cs_white_color cs_fs_100 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.2s">
                    Destinations</h1>
            </div>
            <div class="cs_find_form_wrap">
                <form action="#" class="cs_find_form">
                    <div>
                        <h2 class="cs_fs_18 cs_normal mb-0">Where to?</h2>
                    </div>
                    <div>
                        <select name="cars" class="st_select">
                            <option value="Destination">Destination</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                    <div>
                        <select name="cars" class="st_select">
                            <option value="Guests">Guests</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div>
                        <button class="cs_find_btn cs_bold cs_primary_font cs_center"><i
                                class="fa-solid fa-magnifying-glass"></i> Find Now</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="cs_hero_shape_1"></div>
        <div class="cs_hero_shape_2"></div>
        <div class="cs_hero_shape_3"></div>
    </section>
    <!-- End Hero Section -->

    <!-- Start destination Section -->
    <section>
        <div class="cs_height_140 cs_height_lg_80"></div>
        <div class="container">
            <div class="cs_grid_1">
                @foreach ($beaches as $beach)
                    <div class="cs_grid_item">
                        <!-- Link tới trang chi tiết bãi biển với ID -->
                        <a href="{{ route('destinationdetails', ['id' => $beach->id]) }}"
                            class="cs_card cs_style_2 cs_zoom position-relative cs_radius_8">
                            <div class="cs_card_thumb w-100 h-100">
                                <!-- Hiển thị hình ảnh bãi biển -->
                                <img src="{{ asset($beach->image_url) }}" alt="Card Image" class="w-100 h-100 cs_zoom_in">
                            </div>
                            <div class="cs_card_content position-absolute">
                                <!-- Hiển thị tên bãi biển -->
                                <h2 class="cs_card_title cs_fs_35 cs_medium cs_white_color">{{ $beach->name }}</h2>
                                <!-- Hiển thị vị trí bãi biển và số chuyến đi (nếu có) -->
                                <p class="cs_card_subtitle cs_fs_18 cs_medium cs_white_color mb-0">{{ $beach->country }}</p>

                                <!-- Tính và hiển thị tổng số sao và số lượng người đánh giá -->
                                @php
                                    $totalReviews = $beach->feedbacks->count();
                                    $averageRating = $totalReviews > 0 ? round($beach->feedbacks->avg('rating'), 1) : 0;
                                @endphp

                                <p class="cs_card_subtitle cs_fs_18 cs_medium cs_white_color mb-0">
                                    Rating:
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $averageRating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    ({{ $totalReviews }} reviews)
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="cs_height_140 cs_height_lg_80"></div>
    </section>
    <!-- End destination Section -->
@endsection
