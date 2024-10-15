@extends('layout.layout')

@section('content')
    <!-- Start Hero Section -->
    <x-hero subTitle=''  img="{{ asset('assets/images/bg4.jpg') }}"  title="{{ $blog->title }}" />
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

                        <!-- Hiển thị nút Edit và Delete nếu là chủ sở hữu -->
                        @if (auth()->check() && auth()->user()->id === $blog->user_id)
                            <div class="mt-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                                    data-bs-target="#editBlogModal{{ $blog->id }}"
                                    style="width: auto; height: 40px; font-size: 14px;">
                                    Edit
                                </button>
                                <form action="{{ route('blog.destroy', $blog->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        style="width: auto; height: 40px; font-size: 14px;">Delete</button>
                                </form>
                            </div>
                        @endif
                    </article>

                    <!-- Modal for Editing Blog -->
                    <div class="modal fade" id="editBlogModal{{ $blog->id }}" tabindex="-1"
                        aria-labelledby="editBlogModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editBlogForm{{ $blog->id }}"
                                        action="{{ route('blog.update', $blog->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Title -->
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Blog Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                value="{{ $blog->title }}" required>
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label for="description" class="form-label">What's on your mind?</label>
                                            <textarea id="description" name="description" class="form-control" rows="4" required>{{ $blog->description }}</textarea>
                                        </div>

                                        <!-- Main Image -->
                                        <div class="mb-3">
                                            <label for="mainImage" class="form-label">Main Image</label>
                                            <input type="file" class="form-control" id="mainImage" name="image_url"
                                                accept="image/*" onchange="previewMainImage(event)">
                                            <div class="mt-3">
                                                <img id="mainImagePreview" src="{{ asset($blog->image_url) }}"
                                                    alt="Main Image" class="img-fluid" style="max-height: 150;">
                                            </div>
                                        </div>

                                        <!-- Additional Images -->
                                        <div class="mb-3">
                                            <label for="additionalImages" class="form-label">Additional Images</label>
                                            <input type="file" class="form-control" id="additionalImages" name="images[]"
                                                multiple accept="image/*" onchange="previewAdditionalImages(event)">
                                            <div id="additionalImagesPreview" class="mt-3 d-flex flex-wrap gap-2">
                                                @foreach ($blog->images as $image)
                                                    <img src="{{ asset($image->image_url) }}" alt="Additional Image"
                                                        class="img-fluid" style="max-height: 100px;">
                                                @endforeach
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" form="editBlogForm{{ $blog->id }}"
                                        class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- User Information --}}
                    <div class="cs_post_author">
                        <div class="d-flex align-items-center mb-3">
                            <div class="cs_author_thumb me-3">
                                <img src="{{ asset($blog->user->img) }}" alt="Avatar" class="rounded-circle"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                            </div>
                            <div>
                                <h3 class="cs_author_title h5 mb-1">{{ $blog->user->name }}</h3>
                                <p class="cs_author_subtitle mb-0">Traveller, Blogger & Photographer</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a href="#" class="btn btn-primary btn-sm me-2"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-primary btn-sm me-2"><i
                                    class="fa-brands fa-twitter"></i></a>
                            <a href="#" class="btn btn-primary btn-sm me-2"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="btn btn-primary btn-sm"><i class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <hr>

                    <div class="cs_comments">
                        <h3 class="cs_fs_24 cs_semibold">Comments</h3>
                        <ol class="cs_comment_list cs_mp0">
                            @foreach ($blog->feedbacks as $feedback)
                                <li class="cs_comment">
                                    <div class="cs_comment_body row">
                                        <div class="col-md-10">
                                            <div class="cs_comment_author cs_fs_20 cs_medium cs_primary_color">
                                                <img src="{{ asset($feedback->user->img) }}" alt="Avatar">
                                                <a href="#">{{ $feedback->user->name }}</a>
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
                                            <p class="cs_comment_subtitle">{{ $feedback->comment }}</p>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            @if (auth()->check() && auth()->user()->id === $feedback->user_id)
                                                <div class="d-flex justify-content-end" style="gap: 10px;">
                                                    <button type="button" class="btn btn-warning"
                                                        style="width: auto; height: 40px; font-size: 14px;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $feedback->id }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('blog.feedback.delete', $feedback->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger cs_medium"
                                                            style="width: auto; height: 40px; font-size: 14px;">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{ $feedback->id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{ $feedback->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $feedback->id }}">
                                                                    Edit Comment
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('blog.feedback.update', $feedback->id) }}"
                                                                    method="POST" id="editForm{{ $feedback->id }}">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="form-group">
                                                                        <label for="comment">Comment</label>
                                                                        <textarea name="comment" id="comment" class="form-control" rows="5">{{ old('comment', $feedback->comment) }}</textarea>
                                                                    </div>

                                                                    <div class="col-lg-6 d-flex align-items-center">
                                                                        <label for="rating">Rating:</label>
                                                                        <div class="star-rating ms-2">
                                                                            <input type="radio"
                                                                                id="editStar5_{{ $feedback->id }}"
                                                                                name="rating" value="5"
                                                                                {{ $feedback->rating == 5 ? 'checked' : '' }} />
                                                                            <label for="editStar5_{{ $feedback->id }}"
                                                                                title="5 stars">★</label>

                                                                            <input type="radio"
                                                                                id="editStar4_{{ $feedback->id }}"
                                                                                name="rating" value="4"
                                                                                {{ $feedback->rating == 4 ? 'checked' : '' }} />
                                                                            <label for="editStar4_{{ $feedback->id }}"
                                                                                title="4 stars">★</label>

                                                                            <input type="radio"
                                                                                id="editStar3_{{ $feedback->id }}"
                                                                                name="rating" value="3"
                                                                                {{ $feedback->rating == 3 ? 'checked' : '' }} />
                                                                            <label for="editStar3_{{ $feedback->id }}"
                                                                                title="3 stars">★</label>

                                                                            <input type="radio"
                                                                                id="editStar2_{{ $feedback->id }}"
                                                                                name="rating" value="2"
                                                                                {{ $feedback->rating == 2 ? 'checked' : '' }} />
                                                                            <label for="editStar2_{{ $feedback->id }}"
                                                                                title="2 stars">★</label>

                                                                            <input type="radio"
                                                                                id="editStar1_{{ $feedback->id }}"
                                                                                name="rating" value="1"
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
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>


                        <form action="{{ route('blog.feedback', $blog->id) }}" method="POST"
                            class="cs_comment_form cs_white_bg cs_radius_5">
                            @csrf
                            <h3 class="cs_fs_24 cs_semibold">Post a Comment</h3>
                            <div class="row cs_gap_y_30">
                                <div class="col-lg-12">
                                    <textarea name="comment" class="cs_gray_bg cs_radius_5 cs_form_field" placeholder="Write Comment" cols="35"
                                        rows="8" required></textarea>
                                </div>

                                <!-- Rating -->
                                <div class="col-lg-6 d-flex align-items-center">
                                    <label for="rating">Rating:</label>
                                    <div class="star-rating ms-2">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating"
                                                value="{{ $i }}" />
                                            <label for="star{{ $i }}"
                                                title="{{ $i }} stars">★</label>
                                        @endfor
                                    </div>
                                </div>
                                @error('rating')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-lg-12">
                                    <button type="submit" class="cs_btn cs_style_1 w-100" id="submitCommentButton">Post
                                        Comment</button>
                                </div>
                            </div>
                        </form>

                        {{-- Popup for login --}}
                        @if (session('error') && session('error') == 'Please log in to comment.')
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var loginPopup = new bootstrap.Modal(document.getElementById('loginPopup'), {});
                                    loginPopup.show();
                                });
                            </script>
                        @endif

                        {{-- Popup for login --}}
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
                <!-- Sidebar -->
                <aside class="col-lg-4">
                    <div class="cs_sidebar cs_right_sidebar">
                        <!-- Category widget -->
                        <div class="cs_sidebar_item cs_gray_bg widget_categories">
                            <h3 class="cs_sidebar_widget_title cs_fs_24 cs_semibold">Category</h3>
                            <hr>
                            <ul class="cs_mp0">
                                <li class="cs_cat_item cs_primary_color"><a href="#">Travels</a><span>(20)</span>
                                </li>
                                <li class="cs_cat_item cs_primary_color"><a href="#">Camping</a><span>(35)</span>
                                </li>
                                <li class="cs_cat_item cs_primary_color"><a href="#">Life Style</a><span>(10)</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Popular Posts widget -->
                        <div class="cs_sidebar_item cs_gray_bg">
                            <h3 class="cs_sidebar_widget_title cs_fs_24 cs_semibold">Popular Posts</h3>
                            <hr>
                            <ul class="cs_recent_posts cs_mp0">
                                @foreach ($popularBlogs as $popularBlog)
                                    <li>
                                        <article class="cs_recent_post">
                                            <a href="{{ route('blogdetails', $popularBlog->id) }}"
                                                class="cs_recent_post_thumb cs_zoom">
                                                <img src="{{ asset($popularBlog->image_url) }}" alt="Post Thumb"
                                                    class="cs_zoom_in w-100 h-100 object-fit-cover">
                                            </a>
                                            <div class="cs_recent_post_info">
                                                <h3 class="cs_recent_post_title cs_fs_16 cs_medium cs_secondary_font">
                                                    <a
                                                        href="{{ route('blogdetails', $popularBlog->id) }}">{{ $popularBlog->title }}</a>
                                                </h3>
                                                <div class="cs_recent_post_date cs_fs_14">
                                                    {{ $popularBlog->created_at->format('F d, Y') }}
                                                </div>
                                                <div class="cs_recent_post_rating">
                                                    <i class="fas fa-star text-warning"></i>
                                                    {{ round($popularBlog->avg_rating, 1) }}
                                                    ({{ $popularBlog->feedback_count }} reviews)
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                                @endforeach
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitCommentButton = document.getElementById('submitCommentButton');
        submitCommentButton.addEventListener('click', function(e) {
            const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
            if (!isAuthenticated) {
                e.preventDefault(); // Ngăn chặn form được submit nếu chưa đăng nhập
                $('#loginPopup').modal('show'); // Hiển thị popup
            }
        });
    });

    function previewMainImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('mainImagePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Preview additional images after selecting files
    function previewAdditionalImages(event) {
        const files = event.target.files;
        const additionalImagesPreview = document.getElementById('additionalImagesPreview');
        additionalImagesPreview.innerHTML = ''; // Clear the previous images

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-fluid');
                img.style.maxHeight = '100px';
                img.style.marginRight = '10px';
                additionalImagesPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
<style>
    .image-container {
        width: 100%;
        /* Chiếm toàn bộ chiều rộng cột */
        height: 250px;
        /* Chiều cao cố định cho ảnh */
        overflow: hidden;
        /* Ẩn phần dư của ảnh nếu vượt quá khung */
        border-radius: 5px;
        /* Bo tròn góc nếu muốn */
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Giữ tỷ lệ ảnh và cắt phần thừa nếu cần */
        border-radius: 5px;
    }
</style>
