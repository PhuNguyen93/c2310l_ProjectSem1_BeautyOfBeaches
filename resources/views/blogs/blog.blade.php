@extends('layout.layout')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Hero section -->
    <x-hero subTitle='Modern & Beautiful Travel Theme' img='assets/images/blogimage.jpg' title='Latest Blog' />

    <div class="cs_height_140 cs_height_lg_80"></div>
    <!-- Blog content -->
    <div class="container">
        <div class="row d-flex">
            <div class="col-lg-8">
                @if (Auth::check())
                    <!-- Form tạo bài viết -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-info text-white">
                            Create a Blog Post
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <!-- Avatar -->
                                <div class="me-3">
                                    <img src="{{ Auth::check() && Auth::user()->img ? asset(Auth::user()->img) : asset('assets/images/default-avatar.png') }}"
                                        alt="Avatar" class="rounded-circle"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                </div>
                                <!-- Textarea -->
                                <textarea id="postTextarea" class="form-control" placeholder="What's on your mind?" rows="1"
                                    onclick="showPostModal()"></textarea>
                            </div>

                            <!-- Options below the textarea -->
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#createPostModal">
                                    <i class="fa fa-camera"></i> Photo
                                </button>
                                <button class="btn btn-info text-white" onclick="showPostModal()">Create Post</button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createPostModalLabel">Create a Blog Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="postForm" action="{{ route('blog.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Blog Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <!-- Text -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">What's on your mind?</label>
                                        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                                    </div>
                                    <!-- Image-->
                                    <div class="mb-3">
                                        <label for="blogImages" class="form-label">Add Photos</label>
                                        <input class="form-control" type="file" id="blogImages" name="images[]" multiple>
                                    </div>

                                    <!-- Image preview -->
                                    <div id="imagePreview" class="d-flex flex-wrap"></div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" form="postForm" class="btn btn-primary">Post</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function showPostModal() {
                        var createPostModal = new bootstrap.Modal(document.getElementById('createPostModal'), {});
                        createPostModal.show();
                    }
                    document.getElementById('blogImages').addEventListener('change', function(event) {
                        const imagePreviewContainer = document.getElementById('imagePreview');
                        imagePreviewContainer.innerHTML = ''; // Clear previous previews

                        // Lấy các file đã chọn
                        const files = event.target.files;

                        // Duyệt qua các file đã chọn và tạo preview
                        Array.from(files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                // Tạo một thẻ img để hiển thị ảnh
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.width = '100px';
                                img.style.height = '100px';
                                img.style.objectFit = 'cover';
                                img.style.marginRight = '10px';
                                img.classList.add('img-thumbnail');

                                // Thêm hình ảnh vào khu vực preview
                                imagePreviewContainer.appendChild(img);
                            };

                            // Đọc file dưới dạng URL
                            reader.readAsDataURL(file);
                        });
                    });
                </script>

                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: '{{ session('error') }}',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    </script>
                @endif

                @if ($blogs->isEmpty())
                    <p>No blogs found for "{{ request('search') }}"</p>
                @else
                    @foreach ($blogs as $blog)
                        <!-- Hiển thị blog -->
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
                    <!-- Hiển thị phân trang -->
                    <div class="mt-5">
                        {{ $blogs->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="col-lg-4 flex-column">
                <div class="cs_sidebar cs_right_sidebar flex-grow-1">
                    <!-- Search widget -->
                    <div class="cs_sidebar_item cs_gray_bg widget_search">
                        <form class="cs_sidebar_search cs_white_bg" action="{{ route('user.blog') }}" method="GET">
                            <input type="text" name="search" placeholder="Search..."
                                value="{{ request('search') }}">
                            <button class="cs_sidebar_search_btn cs_accent_bg cs_white_color">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
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
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Traveling</a>
                            <a href="#" class="cs_tag_link cs_radius_5 cs_white_bg cs_primary_color">Camping</a>
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

    <div class="cs_height_140 cs_height_lg_80"></div>
@endsection
