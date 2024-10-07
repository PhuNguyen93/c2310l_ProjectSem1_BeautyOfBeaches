@extends('layout.layout')

@section('content')
    <x-hero subTitle='Modern & Beautiful Travel Theme' img='assets/images/destination_header_bg.jpeg' title='Latest Blog' />

    <div class="cs_height_140 cs_height_lg_80"></div>
    <div class="container">
        <div class="row cs_gap_y_50">
            <div class="col-lg-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Add New Post</button>

                {{-- <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Đăng Bài Viết Mới</h5>
                        <form action="{{ route('store.blog') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="postTitle" class="form-label">Tiêu đề bài viết</label>
                                <input type="text" id="postTitle" name="title" class="form-control" placeholder="Nhập tiêu đề" required>
                            </div>
                            <div class="mb-3">
                                <label for="descriptionInput" class="form-label">Mô tả</label>
                                <textarea class="form-control" id="descriptionInput" name="description" rows="3" placeholder="Chia sẻ suy nghĩ của bạn..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="images" class="form-label">Hình ảnh</label>
                                <input type="file" name="images[]" class="form-control" id="images" multiple required>
                                <div class="form-text">Chọn nhiều hình ảnh nếu cần.</div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Đăng Bài</button>
                            </div>
                        </form>
                    </div>
                </div> --}}


                @foreach ($blogs as $blog)
                    <article class="cs_post cs_style_5">
                        <a href="{{ route('blogdetails', $blog->id) }}" class="cs_post_thumb cs_zoom">
                            <img src="{{ $blog->image_url }}" alt="Post Thumb" class="w-100 h-100 cs_zoom_in">
                            <span class="cs_link_hover"><i class="fas fa-link"></i></span>
                        </a>
                        <ul class="cs_post_meta cs_mp0 cs_primary_color">
                            <li class="cs_accent_color">{{ $blog->created_at->format('F d, Y') }}</li>
                            <li>By <a href="#" class="cs_accent_color">{{ $blog->user->name }}</a></li>
                        </ul>
                        <h2 class="cs_post_title cs_fs_35 cs_semibold">
                            <a href="{{ route('blogdetails', $blog->id) }}">{{ $blog->title }}</a>
                        </h2>
                        <div class="cs_post_subtitle">{{ $blog->description }}</div>
                        <a href="{{ route('blogdetails', $blog->id) }}"
                            class="cs_post_btn cs_fs_18 cs_medium cs_primary_color">
                            <span>Continue Reading</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </article>
                @endforeach
                <ul class="cs_pagination_box cs_mp0">
                    <li>
                        <a class="cs_pagination_item cs_center cs_fs_18 cs_medium active" href="#">1</a>
                    </li>
                    <li>
                        <a class="cs_pagination_item cs_center cs_fs_18 cs_medium" href="#">2</a>
                    </li>
                    <li>
                        <a class="cs_pagination_item cs_center cs_fs_18 cs_medium" href="#">3</a>
                    </li>
                    <li>
                        <a href="#" class="cs_pagination_item cs_center cs_fs_18 cs_medium">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <aside class="col-lg-4">
                <div class="cs_sidebar cs_right_sidebar">
                    <div class="cs_sidebar_item cs_gray_bg widget_search">
                        <form class="cs_sidebar_search cs_white_bg" action="#">
                            <input type="text" placeholder="Search...">
                            <button class="cs_sidebar_search_btn cs_accent_bg cs_white_color">
                                <i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
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
                                <div>(35)</div>
                            </li>
                            <li class="cs_cat_item cs_primary_color">
                                <a href="#">Life Style</a>
                                <div>(10)</div>
                            </li>
                            <li class="cs_cat_item cs_primary_color">
                                <a href="#">Sight Seeing</a>
                                <span>(25)</span>
                            </li>
                            <li class="cs_cat_item cs_primary_color">
                                <a href="#">Trekking</a>
                                <span>(40)</span>
                            </li>
                            <li class="cs_cat_item">
                                <a href="#">Traveling</a>
                                <span>(25)</span>
                            </li>
                        </ul>
                    </div>
                    <div class="cs_sidebar_item cs_gray_bg">
                        <h3 class="cs_sidebar_widget_title cs_fs_24 cs_semibold">Popular Post</h3>
                        <hr>
                        <ul class="cs_recent_posts cs_mp0">
                            <li>
                                <article class="cs_recent_post">
                                    <a href="{{ route('blogdetails') }}" class="cs_recent_post_thumb cs_zoom">
                                        <img src="assets/images/latest_post_1.jpeg" alt="Post Thumb"
                                            class="cs_zoom_in w-100 h-100 object-fit-cover">
                                    </a>
                                    <div class="cs_recent_post_info">
                                        <h3 class="cs_recent_post_title cs_fs_16 cs_medium cs_secondary_font">
                                            <a href="{{ route('blogdetails') }}">How to Modify Your Car engine
                                                Properly?</a>
                                        </h3>
                                        <div class="cs_recent_post_date cs_fs_14">October 01, 2024</div>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="cs_recent_post">
                                    <a href="{{ route('blogdetails') }}" class="cs_recent_post_thumb cs_zoom">
                                        <img src="assets/images/latest_post_2.jpeg" alt="Post Thumb"
                                            class="cs_zoom_in w-100 h-100 object-fit-cover">
                                    </a>
                                    <div class="cs_recent_post_info">
                                        <h3 class="cs_recent_post_title cs_fs_16 cs_medium cs_secondary_font">
                                            <a href="{{ route('blogdetails') }}">Top 10 New Car Available in our
                                                Showroom</a>
                                        </h3>
                                        <div class="cs_recent_post_date cs_fs_14">October 01, 2024</div>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="cs_recent_post">
                                    <a href="{{ route('blogdetails') }}" class="cs_recent_post_thumb cs_zoom">
                                        <img src="assets/images/latest_post_3.jpeg" alt="Post Thumb"
                                            class="cs_zoom_in w-100 h-100 object-fit-cover">
                                    </a>
                                    <div class="cs_recent_post_info">
                                        <h3 class="cs_recent_post_title cs_fs_16 cs_medium cs_secondary_font">
                                            <a href="{{ route('blogdetails') }}">How to Cool Your Car Engine Emidietly</a>
                                        </h3>
                                        <div class="cs_recent_post_date cs_fs_14">October 01, 2024</div>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="cs_recent_post">
                                    <a href="{{ route('blogdetails') }}" class="cs_recent_post_thumb cs_zoom">
                                        <img src="assets/images/latest_post_4.jpeg" alt="Post Thumb"
                                            class="cs_zoom_in w-100 h-100 object-fit-cover">
                                    </a>
                                    <div class="cs_recent_post_info">
                                        <h3 class="cs_recent_post_title cs_fs_16 cs_medium cs_secondary_font">
                                            <a href="{{ route('blogdetails') }}">Classification of Car Wash Type By
                                                Service</a>
                                        </h3>
                                        <div class="cs_recent_post_date cs_fs_14">October 01, 2024</div>
                                    </div>
                                </article>
                            </li>
                        </ul>
                    </div>
                    <div class="cs_sidebar_item cs_gray_bg widget_tag_cloud">
                        <h3 class="cs_sidebar_widget_title cs_fs_24 cs_semibold">Tag Cloud</h3>
                        <hr>
                        <div class="cs_tag_cloud">
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Campaign</a>
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Making</a>
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Life Style</a>
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Traveling</a>
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Trekking</a>
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Travels</a>
                        </div>
                    </div>
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
    <div class="cs_height_140 cs_height_lg_80"></div>
@endsection
