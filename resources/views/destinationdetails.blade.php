@extends('layout.layout')
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQgZ6Fs6ErAf0bL5tV7fSAg57ocLGAI6k&callback=initMap"></script>
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
                        <p>{!! nl2br(e($beach->description)) !!}</p>
                        <div class="cs_tabs">
                            <ul class="cs_tab_links cs_style_1 cs_mp0">
                                <li class="active"><a href="#tab_2"
                                        class="cs_primary_bg cs_white_color cs_radius_5">Location</a></li>
                                <li><a href="#tab_3" class="cs_primary_bg cs_white_color cs_radius_5">Gallery</a></li>
                                <li><a href="#tab_4" class="cs_primary_bg cs_white_color cs_radius_5">Reviews</a></li>
                                <li><a href="#tab_5" class="cs_primary_bg cs_white_color cs_radius_5">Download</a></li>
                            </ul>
                            <div class="cs_tab_body">
                                <div class="cs_tab active" id="tab_2">
                                    <iframe id="map"
                                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDo2qqju6Oddo4SkAaIZBD2tUcOCsgYSmU&q={{ urlencode($beach->location) }}"
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
                                            <div class="col-lg-4 text-center">
                                                <h3>{{ $averageRating }}</h3>
                                                <div>
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

                                            <div class="col-lg-8">
                                                @foreach ([5, 4, 3, 2, 1] as $star)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            {{ $star }} <i class="fas fa-star text-warning"></i>
                                                        </div>

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

                                                        <div class="flex-shrink-0">
                                                            {{ $ratingCount[$star] }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cs_tab" id="tab_5">
                                    <div class="container mt-5">
                                        <h3 class="mb-4">Download</h3>
                                        @if (auth()->check() && auth()->user()->role_id == 2)
                                            <div class="mb-4">
                                                <form action="{{ route('beaches.store_pdf', $beach->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="pdf_file">Upload PDF</label>
                                                        <input type="file" name="pdf_file" class="form-control" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-3">Add PDF</button>
                                                </form>
                                            </div>
                                        @endif

                                        @if ($beach->downloads->count() > 0)
                                            <ul class="list-group">
                                                @foreach ($beach->downloads as $download)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $download->file_name }}
                                                        <div class="d-flex justify-content-end" style="gap: 10px;">
                                                            @if (auth()->check())
                                                                <a href="{{ asset($download->file_url) }}"
                                                                    class="btn btn-success"
                                                                    style="width: auto; height: 40px; font-size: 14px;"
                                                                    download>Download</a>
                                                            @else
                                                                <button class="btn btn-secondary"
                                                                    style="width: auto; height: 40px; font-size: 14px;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#loginPopup">Download</button>
                                                            @endif

                                                            @if (auth()->check() && auth()->user()->role_id == 2)
                                                                <form
                                                                    action="{{ route('beaches.delete_pdf', $download->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this PDF?');"
                                                                    class="d-flex">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger"
                                                                        style="width: auto; height: 40px; font-size: 14px;">Delete</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No files available for download.</p>
                                        @endif
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

                    {{-- form trần gia bảo --}}
                    <form action="" id="flightForm" onsubmit="redirectToAgoda(event)" method="POST">
                        @csrf
                        <div class="search-box">
                            <div class="search-item">
                                <label for="destination">Destination</label>
                                <input type="text" id="destination" name="destination" placeholder="Enter destination">
                            </div>

                            <div class="search-item">
                                <label for="checkin">Check-in date</label>
                                <input type="date" id="checkin" name="checkin">
                            </div>

                            <div class="search-item">
                                <label for="checkout">Check-out date</label>
                                <input type="date" id="checkout" name="checkout">
                            </div>

                            <div class="search-item">
                                <label for="guests">Guest</label>
                                <select id="guests" name="guests">
                                    <option value="1">1 adult</option>
                                    <option value="2">2 adult</option>
                                    <option value="3">3 adult</option>
                                    <option value="3">1 adult 1 Children</option>
                                    <option value="3">2 adult 2 Children</option>
                                </select>
                            </div>

                            <a href="https://www.agoda.com/vi-vn/flights/airport/HAN/SGN/hanoi-ho-chi-minh-city.html?cid=1834233&tag=05692e1d-05cb-461f-9cf8-90ce9e5067cb&gad_source=1&gclid=Cj0KCQjwsJO4BhDoARIsADDv4vDlKdJ72VP6-hAqxeWVWGkN7R3KMoCKYEL0__TyFHJ3mJUTenxowrkaAvyMEALw_wcB" class="search-button" target="_blank">Search</a>
                           </div>
                    </form>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f8f8f8;
                        }

                        .search-container {
                            margin: 50px auto;
                            width: 80%;
                            max-width: 900px;
                        }

                        .search-box {
                            display: flex;
                            background-color: white;
                            border: 2px solid #f0ad4e;
                            border-radius: 5px;
                            padding: 20px;
                            justify-content: space-between;
                            align-items: center;
                        }

                        .search-item {
                            flex: 1;
                            margin-right: 20px;
                        }

                        .search-item:last-child {
                            margin-right: 0;
                        }

                        .search-item label {
                            display: block;
                            margin-bottom: 5px;
                            font-weight: bold;
                        }

                        .search-item input,
                        .search-item select {
                            width: 100%;
                            padding: 10px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                        }

                        .search-button {
                            background-color: #007bff;
                            color: white;
                            padding: 10px 20px;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                        }

                        .search-button:hover {
                            background-color: #0056b3;
                        }
                    </style>

                    <hr>

                    <div class="cs_comments">
                        <h3 class="cs_fs_24 cs_semibold">Comment</h3>
                        <div class="cs_filter_rating mb-4">
                            <div class="d-flex justify-content-start">
                                <button class="btn btn-outline-primary me-2 filter-rating" data-rating="all">All</button>
                                @for ($i = 5; $i >= 1; $i--)
                                    <button class="btn btn-outline-primary me-2 filter-rating"
                                        data-rating="{{ $i }}">{{ $i }} <i
                                            class="fas fa-star text-warning"></i></button>
                                @endfor
                            </div>
                        </div>

                        <ol class="cs_comment_list cs_mp0" id="comments-list">
                            @foreach ($feedbacks as $feedback)
                                <li class="cs_comment" data-rating="{{ $feedback->rating }}">
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
                                                <div class="d-flex justify-content-end" style="gap: 10px;">
                                                    <button type="button" class="btn btn-warning"
                                                        style="width: auto; height: 40px; font-size: 14px;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $feedback->id }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('feedbacks.destroy', $feedback->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirmDelete();">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger cs_medium"
                                                            style="width: auto; height: 40px; font-size: 14px;">Del</button>
                                                    </form>
                                                </div>

                                                <script>
                                                    function confirmDelete() {
                                                        return confirm('Are you sure you want to delete this feedback?');
                                                    }
                                                </script>
                                            @endif
                                        </div>

                                        <div class="modal fade" id="editModal{{ $feedback->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $feedback->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $feedback->id }}">
                                                            Edit Comment</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('feedbacks.update', $feedback->id) }}"
                                                            method="POST" id="editForm{{ $feedback->id }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label for="message">Comment</label>
                                                                <textarea name="message" id="message" class="form-control" rows="5" required>{{ old('message', $feedback->message) }}</textarea>
                                                            </div>

                                                            <div class="col-lg-6 d-flex align-items-center">
                                                                <label for="rating">Rating:</label>
                                                                <div class="star-rating ms-2">
                                                                    <input type="radio"
                                                                        id="editStar5_{{ $feedback->id }}" name="rating"
                                                                        value="5"
                                                                        {{ $feedback->rating == 5 ? 'checked' : '' }} />
                                                                    <label for="editStar5_{{ $feedback->id }}"
                                                                        title="5 stars">★</label>

                                                                    <input type="radio"
                                                                        id="editStar4_{{ $feedback->id }}" name="rating"
                                                                        value="4"
                                                                        {{ $feedback->rating == 4 ? 'checked' : '' }} />
                                                                    <label for="editStar4_{{ $feedback->id }}"
                                                                        title="4 stars">★</label>

                                                                    <input type="radio"
                                                                        id="editStar3_{{ $feedback->id }}" name="rating"
                                                                        value="3"
                                                                        {{ $feedback->rating == 3 ? 'checked' : '' }} />
                                                                    <label for="editStar3_{{ $feedback->id }}"
                                                                        title="3 stars">★</label>

                                                                    <input type="radio"
                                                                        id="editStar2_{{ $feedback->id }}" name="rating"
                                                                        value="2"
                                                                        {{ $feedback->rating == 2 ? 'checked' : '' }} />
                                                                    <label for="editStar2_{{ $feedback->id }}"
                                                                        title="2 stars">★</label>

                                                                    <input type="radio"
                                                                        id="editStar1_{{ $feedback->id }}" name="rating"
                                                                        value="1"
                                                                        {{ $feedback->rating == 1 ? 'checked' : '' }} />
                                                                    <label for="editStar1_{{ $feedback->id }}"
                                                                        title="1 star">★</label>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" form="editForm{{ $feedback->id }}"
                                                            class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>

                        <form action="{{ route('feedbacks.store', $beach->id) }}" method="POST"
                            class="cs_comment_form cs_white_bg cs_radius_5" id="commentForm">
                            @csrf
                            <h3 class="cs_fs_24 cs_semibold">Post Comment</h3>
                            <div class="row row cs_gap_y_30">
                                <div class="col-lg-12">
                                    <textarea class="cs_gray_bg cs_radius_5 cs_form_field" name="message" placeholder="Write Comment" cols="35"
                                        rows="8" required>{{ old('message') }}</textarea>
                                </div>

                                <div class="col-lg-6 d-flex align-items-center">
                                    <label for="rating">Rating:</label>
                                    <div class="star-rating ms-2">
                                        <input type="radio" id="star5" name="rating" value="5"
                                            {{ old('rating') == 5 ? 'checked' : '' }} />
                                        <label for="star5" title="5 stars">★</label>
                                        <input type="radio" id="star4" name="rating" value="4"
                                            {{ old('rating') == 4 ? 'checked' : '' }} />
                                        <label for="star4" title="4 stars">★</label>
                                        <input type="radio" id="star3" name="rating" value="3"
                                            {{ old('rating') == 3 ? 'checked' : '' }} />
                                        <label for="star3" title="3 stars">★</label>
                                        <input type="radio" id="star2" name="rating" value="2"
                                            {{ old('rating') == 2 ? 'checked' : '' }} />
                                        <label for="star2" title="2 stars">★</label>
                                        <input type="radio" id="star1" name="rating" value="1"
                                            {{ old('rating') == 1 ? 'checked' : '' }} />
                                        <label for="star1" title="1 star">★</label>
                                    </div>
                                    @error('rating')
                                        <span class="text-danger ms-3">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="cs_btn cs_style_1 w-100" id="submitCommentButton">Post
                                        Comment</button>
                                </div>
                            </div>
                        </form>

                        <!-- Popup chung cho người dùng chưa đăng nhập -->
                        <div id="loginPopup" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">You're not logged in</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Please log in to perform this action.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Destination:</h3>
                                    <p class="cs_info_subtitle mb-0">{{ $beach->name }}</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Location:</h3>
                                    <p class="cs_info_subtitle mb-0">{{ $beach->location }}</p>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Average Rating:</h3>
                                    <div class="cs_rating_container">
                                        <div class="cs_rating scale_half" data-rating="{{ $averageRating }}">
                                            <div class="cs_rating_percentage"></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="cs_info_item">
                                    <h3 class="cs_info_title cs_fs_16 cs_semibold mb-0">Total Reviews</h3>
                                    <p class="cs_info_subtitle mb-0">{{ $totalReviews }}</p>
                                </li>
                            </ul>
                        </div>

                        <div class="cs_post_widget">
                            <h3 class="cs_widget_title cs_fs_24 cs_semibold">Popular Beaches</h3>
                            <ul class="cs_recent_posts cs_mp0">
                                @foreach ($popularBeaches as $popularBeach)
                                    <li>
                                        <article class="cs_recent_post">
                                            <a href="{{ route('destinationdetails', $popularBeach->id) }}"
                                                class="cs_recent_post_thumb cs_zoom">
                                                <img src="{{ asset($popularBeach->image_url) }}" alt="Post Thumb"
                                                    class="cs_zoom_in w-100 h-100 object-fit-cover">
                                            </a>
                                            <div class="cs_recent_post_info">
                                                <h3 class="cs_recent_post_title cs_fs_18 cs_medium">
                                                    <a
                                                        href="{{ route('destinationdetails', $popularBeach->id) }}">{{ $popularBeach->name }}</a>
                                                </h3>
                                                <div class="cs_recent_post_meta">
                                                    <span>{{ $popularBeach->location }},
                                                        {{ $popularBeach->feedbacks_count }} Reviews,
                                                        <div class="cs_rating scale_half"
                                                            data-rating="{{ round($popularBeach->feedbacks_avg_rating, 1) }}">
                                                            <div class="cs_rating_percentage"></div>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                                @endforeach
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
    document.addEventListener('DOMContentLoaded', function() {
        // Bắt sự kiện khi người dùng chọn rating
        document.querySelectorAll('.star-rating input').forEach((star) => {
            star.addEventListener('click', function() {
                console.log(`Rating selected: ${this.value}`);
            });
        });

        // Bắt sự kiện lọc comment dựa trên rating
        const filterButtons = document.querySelectorAll('.filter-rating');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                const comments = document.querySelectorAll('#comments-list .cs_comment');

                if (rating === 'all') {
                    // Hiển thị tất cả comment
                    comments.forEach(comment => {
                        comment.style.display = 'block';
                    });
                } else {
                    // Ẩn tất cả comment trước
                    comments.forEach(comment => {
                        comment.style.display = 'none';
                    });

                    // Hiển thị comment có rating tương ứng
                    const filteredComments = document.querySelectorAll(
                        `#comments-list .cs_comment[data-rating="${rating}"]`);
                    filteredComments.forEach(comment => {
                        comment.style.display = 'block';
                    });
                }
            });
        });

        // Bắt sự kiện nếu người dùng chưa đăng nhập, hiển thị popup
        const downloadButtons = document.querySelectorAll('.btn-success');
        downloadButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
                if (!isAuthenticated) {
                    e.preventDefault(); // Ngăn chặn form được submit nếu chưa đăng nhập
                    $('#loginPopup').modal('show'); // Hiển thị popup
                }
            });
        });

        const submitCommentButton = document.getElementById('submitCommentButton');
        submitCommentButton.addEventListener('click', function(e) {
            const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
            if (!isAuthenticated) {
                e.preventDefault(); // Ngăn chặn form được submit nếu chưa đăng nhập
                $('#loginPopup').modal('show'); // Hiển thị popup
            }
        });
    });
    @if (session('success'))
        alert('Success: {{ session('success') }}');
    @endif

    // Hiển thị popup khi xóa PDF thành công
    @if (session('delete'))
        alert('Deleted: {{ session('delete') }}');
    @endif
</script>
