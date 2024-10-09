@extends('layout.layout')

@section('content')
    <!-- Hero section -->
    <x-hero subTitle='Modern & Beautiful Travel Theme' img='assets/images/destination_header_bg.jpeg' title='Latest Blog' />

    <!-- Khoảng cách tùy chỉnh -->
    <div class="cs_height_140 cs_height_lg_80"></div>

    <!-- Blog content -->
    <div class="container">
        <div class="row cs_gap_y_50">
            <div class="col-lg-8">
                <!-- Thông báo thành công sau khi đăng bài -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @foreach ($blogs as $blog)
                    <article class="cs_post cs_style_5">
                        <a href="{{ route('blogdetails', $blog->id) }}" class="cs_post_thumb cs_zoom">
                            @if ($blog->image_url)
                                <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}"
                                    class="w-100 h-100 cs_zoom_in">
                            @else
                                <span class="badge bg-secondary">No Image</span>
                            @endif
                            <span class="cs_link_hover"><i class="fas fa-link"></i></span>
                        </a>
                        <ul class="cs_post_meta cs_mp0 cs_primary_color">
                            <li class="cs_accent_color">{{ $blog->created_at->format('F d, Y') }}</li>
                            <li>By <a href="#" class="cs_accent_color">{{ $blog->user->name }}</a></li>
                        </ul>
                        <h2 class="cs_post_title cs_fs_35 cs_semibold">
                            <a href="{{ route('blogdetails', $blog->id) }}">{{ $blog->title }}</a>
                        </h2>
                        <div class="cs_post_subtitle">{{ Str::limit($blog->description, 300) }}</div>
                        <a href="{{ route('blogdetails', $blog->id) }}"
                            class="cs_post_btn cs_fs_18 cs_medium cs_primary_color">
                            <span>Continue Reading</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </article>
                @endforeach
                <!-- Phân trang -->
                <div class="mt-5">
                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="col-lg-4">
                <div class="cs_sidebar cs_right_sidebar">
                    <!-- Search widget -->
                    <div class="cs_sidebar_item cs_gray_bg widget_search">
                        <form class="cs_sidebar_search cs_white_bg" action="#">
                            <input type="text" placeholder="Search...">
                            <button class="cs_sidebar_search_btn cs_accent_bg cs_white_color">
                                <i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>

                    <!-- Category widget -->
                    <div class="cs_sidebar_item cs_gray_bg widget_categories">
                        <h3 class="cs_sidebar_widget_title cs_fs_24 cs_semibold">Category</h3>
                        <hr>
                        <ul class="cs_mp0">
                            <li class="cs_cat_item cs_primary_color">
                                <a href="#">Travels</a>
                                <span>(20)</span>
                            </li>
                            <li class="cs_cat_item cs_primary_color">
                                <a href="#">Camping</a>
                                <span>(35)</span>
                            </li>
                            <!-- Thêm các danh mục khác nếu có -->
                        </ul>
                    </div>

                    <!-- Popular Posts widget -->
                    <div class="cs_sidebar_item cs_gray_bg">
                        <h3 class="cs_sidebar_widget_title cs_fs_24 cs_semibold">Popular Posts</h3>
                        <hr>
                        <ul class="cs_recent_posts cs_mp0">
                            <li>
                                <article class="cs_recent_post">
                                    <a href="#" class="cs_recent_post_thumb cs_zoom">
                                        <img src="assets/images/latest_post_1.jpeg" alt="Post Thumb"
                                            class="cs_zoom_in w-100 h-100 object-fit-cover">
                                    </a>
                                    <div class="cs_recent_post_info">
                                        <h3 class="cs_recent_post_title cs_fs_16 cs_medium cs_secondary_font">
                                            <a href="#">How to Modify Your Car Engine Properly?</a>
                                        </h3>
                                        <div class="cs_recent_post_date cs_fs_14">October 01, 2024</div>
                                    </div>
                                </article>
                            </li>
                            <!-- Thêm các bài viết phổ biến khác -->
                        </ul>
                    </div>

                    <!-- Tag Cloud widget -->
                    <div class="cs_sidebar_item cs_gray_bg widget_tag_cloud">
                        <h3 class="cs_sidebar_widget_title cs_fs_24 cs_semibold">Tag Cloud</h3>
                        <hr>
                        <div class="cs_tag_cloud">
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Traveling</a>
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Camping</a>
                            <!-- Thêm các tag khác -->
                        </div>
                    </div>

                    <!-- Newsletter widget -->
                    <div class="cs_sidebar_item cs_gray_bg">
                        <h3 class="cs_sidebar_widget_title cs_fs_24 cs_semibold">Newsletter</h3>
                        <hr>
                        <form class="cs_subscribe_form">
                            <div class="cs_input_field">
                                <input type="text" placeholder="Enter E-Mail">
                                <span><i class="fa-regular fa-envelope"></i></span>
                            </div>
                            <button type="submit" class="cs_btn cs_style_1 cs_fs_18 cs_medium cs_radius_4">Subscribe
                                Now</button>
                        </form>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <!-- Khoảng cách tùy chỉnh -->
    <div class="cs_height_140 cs_height_lg_80"></div>
@endsection
