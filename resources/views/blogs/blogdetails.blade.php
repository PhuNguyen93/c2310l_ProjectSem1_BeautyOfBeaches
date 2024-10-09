@extends('layout.layout')

@section('content')
    <!-- Start Hero Section -->
    <x-hero subTitle='Modern & Beautiful TravelPro Theme' img='assets/images/destination_header_bg.jpeg'
        title="{{ $blog->title }}" />
    <!-- End Hero Section -->

    <!-- Start Blog Section -->
    <section>
        <div class="cs_height_140 cs_height_lg_80"></div>
        <div class="container">
            <div class="row cs_gap_y_50">
                <div class="col-lg-8">
                    <article class="cs_post_details">
                        <div class="position-relative">
                            <img src="{{ asset($blog->image_url) }}" alt="Post Thumb" class="img-fluid w-100">
                            <span class="cs_post_label">Travel/Tour</span>
                        </div>

                        <ul class="cs_post_meta cs_mp0 cs_primary_color">
                            <li><i
                                    class="fa-solid fa-calendar-days cs_accent_color"></i>{{ $blog->created_at->format('F d, Y') }}
                            </li>
                            <li><i class="fa-regular fa-user cs_accent_color"></i>{{ $blog->user->name }}</li>
                        </ul>

                        <h2>{{ $blog->title }}</h2>
                        <p>{!! nl2br(e($blog->description)) !!}</p>
                        @if ($blog->images->count() > 0)
                            <div class="row">
                                @foreach ($blog->images as $image)
                                    <div class="col-sm-6 mb-3">
                                        <div class="image-container">
                                            <img src="{{ asset($image->image_url) }}" alt="Blog Image" class="img-fluid">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </article>

                    <div class="cs_social_btns cs_primary_color">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>

                    <div class="cs_post_author">
                        <div class="cs_author_top d-flex">
                            <div class="cs_author_thumb">
                                <img src="{{ asset($blog->user->img) }}" alt="Avatar" class="rounded-circle"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            </div>
                            <div class="cs_author_info">
                                <h3 class="cs_author_title cs_fs_20 cs_medium mb-0">{{ $blog->user->name }}</h3>
                                <p class="cs_author_subtitle mb-0">Traveller, Blogger & Photographer</p>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="cs_comments">
                        <h3 class="cs_fs_24 cs_semibold">Comments</h3>
                        <ol class="cs_comment_list cs_mp0">
                            <li class="cs_comment">
                                <div class="cs_comment_body">
                                    <div class="cs_comment_author cs_fs_20 cs_medium cs_primary_color">
                                        <img src="{{ asset('assets/images/avatar_5.jpeg') }}" alt="Avatar">
                                        <a href="#">Martha Grey</a>
                                    </div>
                                    <p class="cs_comment_subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </p>
                                    <div class="cs_reply_btn"><a class="cs_reply_link cs_radius_5" href="#">Reply</a>
                                    </div>
                                </div>
                            </li>
                        </ol>

                        <form action="" method="POST" class="cs_comment_form cs_white_bg cs_radius_5">
                            @csrf
                            <h3 class="cs_fs_24 cs_semibold">Post a Comment</h3>
                            <div class="row cs_gap_y_30">
                                <div class="col-lg-12">
                                    <textarea name="comment" class="cs_gray_bg cs_radius_5 cs_form_field" placeholder="Write Comment" cols="35"
                                        rows="8" required></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <button class="cs_btn cs_style_1 w-100">Post Comment</button>
                                </div>
                            </div>
                        </form>
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
                                <li class="cs_cat_item cs_primary_color"><a href="#">Travels</a><span>(20)</span></li>
                                <li class="cs_cat_item cs_primary_color"><a href="#">Camping</a><span>(35)</span></li>
                                <li class="cs_cat_item cs_primary_color"><a href="#">Life Style</a><span>(10)</span>
                                </li>
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
                                                <a href="#">{{ $blog->title }}</a>
                                            </h3>
                                            <div class="cs_recent_post_date cs_fs_14">
                                                {{ $blog->created_at->format('F d, Y') }}</div>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                        </div>

                        <!-- Tag Cloud widget -->
                        <div class="cs_sidebar_item cs_gray_bg widget_tag_cloud">
                            <h3 class="cs_sidebar_widget_title cs_fs_24 cs_semibold">Tag Cloud</h3>
                            <hr>
                            <div class="cs_tag_cloud">
                                <a href="#"
                                    class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Campaign</a>
                                <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Life
                                    Style</a>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
        <div class="cs_height_140 cs_height_lg_80"></div>
    </section>
    <!-- End Blog Section -->

@endsection
<style>
    .image-container {
    width: 100%; /* Chiếm toàn bộ chiều rộng cột */
    height: 250px; /* Chiều cao cố định cho ảnh */
    overflow: hidden; /* Ẩn phần dư của ảnh nếu vượt quá khung */
    border-radius: 5px; /* Bo tròn góc nếu muốn */
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Giữ tỷ lệ ảnh và cắt phần thừa nếu cần */
    border-radius: 5px;
}
</style>
