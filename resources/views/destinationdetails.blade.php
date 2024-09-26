@extends('layout.layout')

@section('content')
    <!-- Start Hero Section -->
    <x-hero subTitle='{{ $beach->name }}' img='{{ asset($beach->image_url) }}' title='Popular Destination' />
    <!-- End Hero Section -->

    <!-- Start Destination Details Section -->
    <section>
        <div class="cs_height_140 cs_height_lg_80"></div>
        <div class="container">
            <div class="row cs_gap_y_50">
                <div class="col-lg-8">
                    <div class="cs_post_details">
                        <h1>{{ $beach->name }}</h1>
                        <p>{{ $beach->description }}</p>
                        <p>{{ $beach->description2 }}</p>
                        <p>{{ $beach->description3 }}</p>
                        <div class="cs_tabs">
                            <ul class="cs_tab_links cs_style_1 cs_mp0">
                                <li class="active"><a href="#tab_2"
                                        class="cs_primary_bg cs_white_color cs_radius_5">Location</a></li>
                                <li><a href="#tab_3" class="cs_primary_bg cs_white_color cs_radius_5">Gallery</a></li>
                                <li><a href="#tab_4" class="cs_primary_bg cs_white_color cs_radius_5">Reviews</a></li>
                            </ul>
                            <div class="cs_tab_body">
                                {{-- @if ($beach->location)
                                        <a href="https://www.google.com/maps?q={{ urlencode($beach->location) }}"
                                            target="_blank">
                                            Xem vị trí Biển Mỹ Khê trên Google Maps
                                        </a>
                                    @else
                                        <p>Không có thông tin vị trí.</p>
                                    @endif --}}
                                <div class="cs_tab active" id="tab_2">
                                    <iframe id="map"
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD-_OQuqIYNqz9RgImViWzdHs2g_j9CUYg&q={{ urlencode($beach->location) }}"
                                        target="_blank" allowfullscreen></iframe>
                                </div>
                                <div class="cs_tab" id="tab_3">
                                    <div class="cs_grid_3 cs_gallery_list cs_style_1">
                                        @foreach ($beach->gallery as $image)
                                            <a href="{{ asset($image->image_url) }}" class="cs_gallery_item cs_zoom">
                                                <img src="{{ asset($image->image_url) }}" alt="{{ $image->caption }}"
                                                    class="cs_zoom_in">
                                                <div class="cs_gallery_overlay"></div>
                                                <div class="cs_gallery_icon position-absolute">
                                                    <img src="{{ asset('assets/images/icons/plus_icon.svg') }}"
                                                        alt="Icon">
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="cs_tab" id="tab_4">
                                    <div class="container mt-5">
                                        <h3 class="mb-4">Our Clients Reviews Details</h3>
                                        <div class="row">
                                            <!-- Cột hiển thị điểm trung bình và tổng số đánh giá -->
                                            <div class="col-lg-4 text-center">
                                                <h3>{{ $averageRating }}</h3>
                                                <div>
                                                    <!-- Hiển thị ngôi sao trung bình -->
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $averageRating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p>{{ $totalReviews }} Reviews</p>
                                            </div>

                                            <!-- Cột hiển thị số lượng đánh giá từng sao -->
                                            <div class="col-lg-8">
                                                @foreach ([5, 4, 3, 2, 1] as $star)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <!-- Số sao -->
                                                        <div class="flex-shrink-0 me-3">
                                                            {{ $star }} <i class="fas fa-star text-warning"></i>
                                                        </div>

                                                        <!-- Thanh tiến trình cho mỗi sao -->
                                                        <div class="progress flex-grow-1 me-3" style="height: 8px;">
                                                            @php
                                                                $percentage =
                                                                    $totalReviews > 0
                                                                        ? ($ratingCount[$star] / $totalReviews) * 100
                                                                        : 0;
                                                            @endphp
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: {{ $percentage }}%;"
                                                                aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>

                                                        <!-- Số lượng đánh giá mỗi sao -->
                                                        <div class="flex-shrink-0">
                                                            {{ $ratingCount[$star] }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="cs_social_btns cs_primary_color">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <hr>
                    <div class="cs_comments">
                        <h3 class="cs_fs_24 cs_semibold">Comment</h3>
                        <ol class="cs_comment_list cs_mp0">
                            @foreach ($beach->feedbacks as $feedback)
                                <li class="cs_comment">
                                    <div class="cs_comment_body row">
                                        <div class="col-md-10">
                                            <div class="cs_comment_author cs_fs_20 cs_semibold cs_primary_color">
                                                <img src="{{ asset('assets/images/avatar_3.jpeg') }}" alt="Avatar"
                                                    class="rounded-circle me-2" width="40" height="40">
                                                <a
                                                    href="#">{{ $feedback->user ? $feedback->user->name : 'Unknown User' }}</a>
                                                <span class="rating-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $feedback->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </span>
                                            </div>
                                            <p class="cs_comment_subtitle">{{ $feedback->message }}</p>
                                        </div>

                                        <div class="col-md-2 text-end">
                                            @if (auth()->check() && (auth()->user()->id === $feedback->user_id || auth()->user()->role == 'admin'))
                                                <form action="{{ route('feedbacks.destroy', $feedback->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger cs_medium">Del</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                        <!-- Kiểm tra nếu người dùng đã đăng nhập, cho phép họ gửi bình luận -->
                        @if (auth()->check())
                            <form action="{{ route('feedbacks.store', $beach->id) }}" method="POST"
                                class="cs_comment_form cs_white_bg cs_radius_5">
                                @csrf
                                <h3 class="cs_fs_24 cs_semibold">Post Comment</h3>
                                <div class="row row cs_gap_y_30">
                                    <div class="col-lg-12">
                                        <textarea class="cs_gray_bg cs_radius_5 cs_form_field" name="message" placeholder="Write Comment" cols="35"
                                            rows="8" required></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <input class="cs_gray_bg cs_radius_5 cs_form_field" type="text" name="name"
                                            value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <input class="cs_gray_bg cs_radius_5 cs_form_field" type="email" name="email"
                                            value="{{ auth()->user()->email }}" readonly>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <label for="rating">Rating:</label>
                                        <div class="star-rating">
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label for="star5" title="5 stars">★</label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label for="star4" title="4 stars">★</label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label for="star3" title="3 stars">★</label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label for="star2" title="2 stars">★</label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label for="star1" title="1 star">★</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="cs_btn cs_style_1 w-100">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <!-- Nếu người dùng chưa đăng nhập, hiển thị nút yêu cầu đăng nhập -->
                            <div class="alert alert-info">
                                <strong>Bạn phải <a href="{{ route('login') }}">đăng nhập</a> để có thể bình luận và đánh
                                    giá.</strong>
                            </div>
                        @endif
                    </div>

                </div>
                <aside class="col-lg-4">
                    <div class="cs_sidebar cs_style_1 cs_white_bg cs_right_sidebar">
                        <div class="cs_info_widget cs_white_bg">
                            <h3 class="cs_widget_title cs_fs_24 cs_medium">Basic Information:</h3>
                            <p class="cs_widget_subtitle">Aliquam lorem ante, dapibus in, viverra quis, feugiat viverra
                                nulla ut metus varius laoreet. Quisque</p>
                            <ul class="cs_info_list cs_mp0">
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Destination</h3>
                                    <p class="cs_info_subtitle mb-0">Iceberg,Greenland</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Duration</h3>
                                    <p class="cs_info_subtitle mb-0">3 Days 2 Nights</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Departure</h3>
                                    <p class="cs_info_subtitle mb-0">Square, Old Town</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Departure Time</h3>
                                    <p class="cs_info_subtitle mb-0">mately 8.30AM</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Return Time</h3>
                                    <p class="cs_info_subtitle mb-0">Approximately 7.30PM</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Dress Code</h3>
                                    <p class="cs_info_subtitle mb-0">Casual <br> comfortable and light</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Included</h3>
                                    <p class="cs_info_subtitle mb-0">Airport Transfer,<br> Personal Guide</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Not Included</h3>
                                    <p class="cs_info_subtitle mb-0">Gallery Ticket, Lunch</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Reviews</h3>
                                    <div class="cs_rating_container">
                                        <div class="cs_rating scale_half" data-rating="4">
                                            <div class="cs_rating_percentage"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="cs_booking_widget cs_gray_bg">
                                <h3 class="cs_widget_title cs_fs_24 cs_medium">Drop Messege For Detais</h3>
                                <form action="" class="cs_booking_form">
                                    <div class="cs_input_field position-relative">
                                        <span><i class="fa-solid fa-user"></i></span>
                                        <input type="text" placeholder="Your Name*" class="cs_form_field cs_radius_5">
                                    </div>
                                    <div class="cs_input_field position-relative">
                                        <span><i class="fa-solid fa-envelope"></i></span>
                                        <input type="email" placeholder="Your Email*"
                                            class="cs_form_field cs_radius_5">
                                    </div>
                                    <div class="cs_input_field position-relative">
                                        <span><i class="fa-solid fa-comment"></i></span>
                                        <textarea rows="5" class="" placeholder="Message"></textarea>
                                    </div>
                                    <button type="submit" class="cs_btn cs_style_1 cs_fs_18 cs_medium cs_radius_4">Send
                                        Message</button>
                                </form>
                            </div>
                        </div>
                        <div class="cs_post_widget">
                            <h3 class="cs_widget_title cs_fs_24 cs_semibold">Popular Destination</h3>
                            <ul class="cs_recent_posts cs_mp0">
                                <li>
                                    <article class="cs_recent_post">
                                        <a href="{{ route('blogdetails') }}" class="cs_recent_post_thumb cs_zoom">
                                            <img src="assets/images/latest_post_5.jpeg" alt="Post Thumb"
                                                class="cs_zoom_in w-100 h-100 object-fit-cover">
                                        </a>
                                        <div class="cs_recent_post_info">
                                            <h3 class="cs_recent_post_title cs_fs_18 cs_medium">
                                                <a href="{{ route('blogdetails') }}">Eiffel Tower</a>
                                            </h3>
                                            <div class="cs_recent_post_meta">
                                                <span>Paris, 24 Trips</span>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                                <li>
                                    <article class="cs_recent_post">
                                        <a href="{{ route('blogdetails') }}" class="cs_recent_post_thumb cs_zoom">
                                            <img src="assets/images/latest_post_6.jpeg" alt="Post Thumb"
                                                class="cs_zoom_in w-100 h-100 object-fit-cover">
                                        </a>
                                        <div class="cs_recent_post_info">
                                            <h3 class="cs_recent_post_title cs_fs_18 cs_medium">
                                                <a href="{{ route('blogdetails') }}">Pryde Mountains</a>
                                            </h3>
                                            <div class="cs_recent_post_meta">
                                                <span>Prydelands, 100 Trips</span>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                                <li>
                                    <article class="cs_recent_post">
                                        <a href="{{ route('blogdetails') }}" class="cs_recent_post_thumb cs_zoom">
                                            <img src="assets/images/latest_post_7.jpeg" alt="Post Thumb"
                                                class="cs_zoom_in w-100 h-100 object-fit-cover">
                                        </a>
                                        <div class="cs_recent_post_info">
                                            <h3 class="cs_recent_post_title cs_fs_18 cs_medium">
                                                <a href="{{ route('blogdetails') }}">Lao Lading Island</a>
                                            </h3>
                                            <div class="cs_recent_post_meta cs_fs_14">
                                                <span>Krabal, 12 Trips</span>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
        <div class="cs_height_140 cs_height_lg_80"></div>
    </section>
    <!-- End Destination Details Section -->
@endsection
<script>
    document.querySelectorAll('.star-rating input').forEach((star) => {
        star.addEventListener('click', function() {
            console.log(`Rating selected: ${this.value}`);
        });
    });
</script>
