@extends('layouts.master')

@section('title')
    {{ __('Blog Comment History') }}
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-page-title title="Blog and Comment History" pagetitle="Blogs and Feedbacks" />

    <div class="mt-5 w-full overflow-x-auto">
        <div class="card-body w-full">
            <h4 class="mb-3 font-semibold text-xl">All Comments on Blogs</h4>

            <!-- Form tìm kiếm -->
            <form method="GET" action="{{ route('blogs.comment') }}" class="mb-4 flex gap-4 items-center">
                <!-- Tìm kiếm theo tên người dùng hoặc tên bài viết -->
                <div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="border border-gray-300 px-2 py-1 rounded-md" placeholder="Enter User or Comment">
                </div>

                <!-- Lọc theo số sao (rating) -->
                <div>
                    <select name="rating" id="ratingFilter" class="border border-gray-300 px-2 py-1 rounded-md">
                        <option value="">All Ratings</option>
                        <option value="5" {{ request('rating') == 5 ? 'selected' : '' }}>5 Stars</option>
                        <option value="4" {{ request('rating') == 4 ? 'selected' : '' }}>4 Stars</option>
                        <option value="3" {{ request('rating') == 3 ? 'selected' : '' }}>3 Stars</option>
                        <option value="2" {{ request('rating') == 2 ? 'selected' : '' }}>2 Stars</option>
                        <option value="1" {{ request('rating') == 1 ? 'selected' : '' }}>1 Star</option>
                    </select>
                </div>

                <!-- Nút Tìm Kiếm -->
                <div>
                    <button type="submit" class="btn bg-custom-500 text-white">
                        Search
                    </button>
                </div>
            </form>

            @if ($feedbacks->isEmpty())
                <p class="text-gray-500">No comments found.</p>
            @else
                <table class="min-w-full w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Avatar</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">User Name</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Blog Title</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Rating</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Comment</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Creation Date</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr class="bg-white border-b border-gray-200">
                                <!-- User Avatar -->
                                <td class="px-6 py-4">
                                    <img src="{{ asset($feedback->user->img ?? 'default-avatar.png') }}" alt="User Avatar"
                                        class="w-12 h-12 rounded-full object-cover">
                                </td>

                                <!-- User Name -->
                                <td class="px-6 py-4 text-gray-700">{{ $feedback->user->name }}</td>

                                <!-- Blog Title -->
                                <td class="px-6 py-4 text-gray-700">{{ $feedback->blog->title }}</td>

                                <!-- Rating -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $feedback->rating)
                                                <span class="text-yellow-400">★</span>
                                            @else
                                                <span class="text-gray-300">★</span>
                                            @endif
                                        @endfor
                                    </div>
                                </td>

                                <!-- Comment -->
                                <td class="px-6 py-4 text-gray-700">{{ Str::limit($feedback->comment, 50, '...') }}</td>

                                <!-- Creation Date -->
                                <td class="px-6 py-4 text-gray-500">{{ $feedback->created_at->format('Y-m-d H:i:s') }}</td>

                                <!-- Action -->
                                <td class="px-3.5 py-2.5 text-end">
                                    <div class="relative dropdown">
                                        <button
                                            class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                            id="feedbackAction{{ $feedback->id }}" data-bs-toggle="dropdown">
                                            <i data-lucide="more-horizontal" class="size-3"></i>
                                        </button>
                                        <ul
                                            class="dropdown-menu absolute hidden z-10 right-0 bg-white shadow-lg rounded-md mt-2">
                                            <li>
                                                <a href="{{ route('blogdetails', $feedback->blog->id) }}"
                                                    class="dropdown-item block px-4 py-2 text-sm hover:bg-gray-100"
                                                    onclick="openFeedbackModal({{ $feedback->id }})">
                                                    <i data-lucide="eye" class="inline-block size-3 mr-1"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('blogs.comment.destroy', $feedback->id) }}"
                                                    method="POST" class="block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="dropdown-item block w-full text-left px-4 py-2 text-sm hover:bg-gray-100"
                                                        onclick="return confirm('Are you sure you want to delete this comment?');">
                                                        <i data-lucide="trash-2" class="inline-block size-3 mr-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
                        <!-- Modal hiển thị thông tin feedback -->
                        <div id="feedbackModal" class="fixed inset-0 z-50 hidden">
                            <div class="flex items-center justify-center min-h-screen px-4 text-center">
                                <div class="modal-content bg-white rounded-lg shadow-xl w-full max-w-md">
                                    <div class="modal-header p-4 border-b">
                                        <h3 class="text-lg font-medium">Feedback Details</h3>
                                    </div>
                                    <div class="modal-body p-4 space-y-4">
                                        <p><strong>User:</strong> <span id="feedback-user"></span></p>
                                        <p><strong>Blog:</strong> <span id="feedback-blog"></span></p>
                                        <p><strong>Rating:</strong> <span id="feedback-rating"></span></p>
                                        <p><span id="feedback-message"></span></p>
                                        <p><strong>Date:</strong> <span id="feedback-date"></span></p>
                                    </div>
                                    <div class="modal-footer flex justify-end p-4 border-t">
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md"
                                            onclick="closeFeedbackModal()">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $feedbacks->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        function openFeedbackModal(id) {
            fetch(`/comment-history/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch feedback details');
                    }
                    return response.json();
                })
                .then(data => {
                    // Điền dữ liệu vào modal
                    document.getElementById('feedback-user').textContent = data.user.name;
                    document.getElementById('feedback-blog').textContent = data.blog.title;
                    document.getElementById('feedback-rating').textContent = data.rating;
                    document.getElementById('feedback-message').textContent = data.message;
                    document.getElementById('feedback-date').textContent = new Date(data.created_at).toLocaleString();

                    // Hiển thị modal
                    document.getElementById('feedbackModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching feedback:', error);
                });
        }

        function closeFeedbackModal() {
            document.getElementById('feedbackModal').classList.add('hidden');
        }
    </script>
@endpush
