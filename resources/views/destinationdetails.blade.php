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
                        <p>{{ $beach->description }}</p>
                        <p>{{ $beach->description2 }}</p>
                        <p>{{ $beach->description3 }}</p>
                        <div class="cs_tabs">
                            <ul class="cs_tab_links cs_style_1 cs_mp0">
                                <li class="active"><a href="#tab_2"
                                        class="cs_primary_bg cs_white_color cs_radius_5">Location</a></li>
                                <li><a href="#tab_3" class="cs_primary_bg cs_white_color cs_radius_5">Gallery</a></li>
                                <li><a href="#tab_4" class="cs_primary_bg cs_white_color cs_radius_5">Reviews</a></li>
                                <li><a href="#tab_5" class="cs_primary_bg cs_white_color cs_radius_5">Dowload</a></li>

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
                                <v class="cs_tab" id="tab_5">
                                    <div class="container mt-5">
                                        <h3 class="mb-4">Download</h3>
                                        @if (auth()->user()->role_id == 2)
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

                                        {{-- Check if there is any PDF file --}}
                                        @if ($beach->downloads->count() > 0)
                                            <ul class="list-group">
                                                @foreach ($beach->downloads as $download)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $download->file_name }}
                                                        <div class="d-flex justify-content-end" style="gap: 10px;">
                                                            <!-- Thêm khoảng cách giữa các nút -->
                                                            <!-- Nút Download -->
                                                            <a href="{{ asset($download->file_url) }}"
                                                                class="btn btn-success" style="width: auto; height: 40px; font-size: 14px;" download>Download</a>

                                                            <!-- Nút Delete, chỉ hiển thị nếu là admin -->
                                                            @if (auth()->user()->role_id == 2)
                                                                <form
                                                                    action="{{ route('beaches.delete_pdf', $download->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this PDF?');" class="d-flex">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger" style="width: auto; height: 40px; font-size: 14px;">Delete</button>
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
                                </v>
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
                        <!-- Phần chọn lọc đánh giá -->
                        <div class="cs_filter_rating mb-4">
                            <div class="d-flex justify-content-start">
                                <button class="btn btn-outline-primary me-2 filter-rating" data-rating="all">
                                    All
                                </button>
                                @for ($i = 5; $i >= 1; $i--)
                                    <button class="btn btn-outline-primary me-2 filter-rating"
                                        data-rating="{{ $i }}">
                                        {{ $i }} <i class="fas fa-star text-warning"></i>
                                    </button>
                                @endfor
                            </div>
                        </div>

                        <!-- Danh sách comment được lọc -->
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
                                                <!-- Sử dụng d-flex và gap để căn hàng và thêm khoảng cách -->
                                                <div class="d-flex justify-content-end" style="gap: 10px;">
                                                    <!-- Nút Edit (mở modal) -->
                                                    <button type="button" class="btn btn-warning" style="width: auto; height: 40px; font-size: 14px;" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $feedback->id }}">
                                                        Edit
                                                    </button>

                                                    <!-- Nút Delete -->
                                                    <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" class="d-inline"
                                                        onsubmit="return confirmDelete();">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger cs_medium" style="width: auto; height: 40px; font-size: 14px;">Del</button>
                                                    </form>
                                                </div>

                                                <script>
                                                    function confirmDelete() {
                                                        return confirm('Are you sure you want to delete this feedback? This action cannot be undone.');
                                                    }
                                                </script>
                                            @endif
                                        </div>


                                        <!-- Modal chỉnh sửa comment -->
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

                                                            <!-- Nội dung comment để chỉnh sửa -->
                                                            <div class="form-group">
                                                                <label for="message">Comment</label>
                                                                <textarea name="message" id="message" class="form-control" rows="5" required>{{ old('message', $feedback->message) }}</textarea>
                                                            </div>

                                                            <!-- Rating -->
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

                        <!-- Form gửi bình luận -->
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
                                    <!-- Hiển thị lỗi kế bên phần rating -->
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

                        <!-- Popup cho người dùng chưa đăng nhập -->
                        <div id="loginPopup" class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">You're not logged in</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Please log in to post a comment.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
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
        const submitButton = document.getElementById('submitCommentButton');
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

        submitButton.addEventListener('click', function(e) {
            if (!isAuthenticated) {
                e.preventDefault(); // Ngăn chặn form được submit nếu chưa đăng nhập
                $('#loginPopup').modal('show'); // Hiển thị popup
            }
        });
    });
     // Hiển thị popup khi thêm PDF thành công
     @if (session('success'))
        alert('Success: {{ session('success') }}');
    @endif

    // Hiển thị popup khi xóa PDF thành công
    @if (session('delete'))
        alert('Deleted: {{ session('delete') }}');
    @endif
</script>
