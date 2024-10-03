@extends('layouts.master')

@section('title')
    {{ __('Beaches and Comment History') }}
@endsection

@section('content')
    <!-- page title -->
    <x-page-title title="Beach and Comment History" pagetitle="Beach and Feedbacks" />

    <div class="mt-5 w-full overflow-x-auto">
        <div class="card-body w-full">
            <h4 class="mb-3 font-semibold text-xl">All Comments on Beaches</h4>

            <!-- Form tìm kiếm -->
            <form method="GET" action="{{ route('comment-history.index') }}" class="mb-4 flex gap-4 items-center">
                <!-- Tìm kiếm theo tên người dùng hoặc tên bãi biển -->
                <div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="border px-2 py-1" placeholder="Enter User or Beach Name">
                </div>

                <!-- Lọc theo số sao (rating) -->
                <div>
                    <select name="rating" id="ratingFilter" class="border px-2 py-1">
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
                <table class="min-w-full w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Avatar</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">User Name</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Beach Name</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Country</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Rating</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Comment</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Creation Date</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-600">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr class="bg-white border-b">
                                <!-- User Avatar -->
                                <td class="px-6 py-4">
                                    <img src="{{ asset($feedback->beach->image_url ?? 'default-avatar.png') }}"
                                        alt="Beach Avatar" class="w-12 h-12 rounded-full object-cover">
                                </td>

                                <!-- User Name -->
                                <td class="px-6 py-4 text-gray-700">{{ $feedback->user->name }}</td>

                                <!-- Beach Name -->
                                <td class="px-6 py-4 text-gray-700">{{ $feedback->beach->name }}</td>

                                <!-- Country -->
                                <td class="px-6 py-4 text-gray-700">{{ $feedback->beach->country }}</td>

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
                                <td class="px-6 py-4 text-gray-700">{{ Str::limit($feedback->message, 50, '...') }}</td>

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
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="feedbackAction{{ $feedback->id }}">
                                            <li>
                                                <a href="#"
                                                    class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500"
                                                    onclick="openFeedbackModal({{ $feedback->id }})">
                                                    <i data-lucide="eye" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                    <span class="align-middle">View</span>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('comment-history.destroy', $feedback->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="block w-full text-left px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                        onclick="return confirm('Are you sure you want to delete this comment?');">
                                                        <i data-lucide="trash-2"
                                                            class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i>
                                                        <span class="align-middle">Delete</span>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <!-- Modal hiển thị thông tin feedback -->
                        <div id="feedbackModal" class="fixed inset-0 z-50 hidden">
                            <div class="flex items-center justify-center min-h-screen px-4 text-center">
                                <div class="modal-content bg-white rounded-lg shadow-xl w-full">
                                    <div class="modal-header p-4 border-b">
                                        <h3 class="text-lg font-medium">Feedback Details</h3>
                                    </div>
                                    <div class="modal-body p-4 space-y-4">
                                        <p><strong>User:</strong> <span id="feedback-user"></span></p>
                                        <p><strong>Beach:</strong> <span id="feedback-beach"></span></p>
                                        <p><strong>Rating:</strong> <span id="feedback-rating"></span></p>
                                        <p><span class="text-base leading-relaxed text-gray-500 dark:text-gray-400"
                                                id="feedback-message"></span></p>
                                        <p><strong>Date:</strong> <span id="feedback-date"></span></p>
                                    </div>
                                    <div class="modal-footer flex justify-end p-4 border-t">
                                        <button class="btn bg-custom-500 text-white"
                                            onclick="closeFeedbackModal()">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>

                </table>
                <!-- Pagination -->
                <div class="flex flex-col items-center mt-8 md:flex-row">
                    <div class="mb-4 grow md:mb-0">
                        <p class="text-slate-500 dark:text-zink-200">Showing <b>{{ $feedbacks->count() }}</b> of
                            <b>{{ $feedbacks->total() }}</b> Results
                        </p>
                    </div>
                    <ul class="flex flex-wrap items-center gap-2">
                        <!-- Nút Previous -->
                        @if ($feedbacks->onFirstPage())
                            <li><span
                                    class="disabled inline-flex items-center justify-center bg-gray-300 text-gray-500 border border-gray-200 rounded px-4 py-2">Previous</span>
                            </li>
                        @else
                            <li><a href="{{ $feedbacks->previousPageUrl() }}"
                                    class="inline-flex items-center justify-center bg-white text-slate-500 border border-slate-200 rounded px-4 py-2 hover:bg-custom-50">Previous</a>
                            </li>
                        @endif

                        <!-- Hiển thị các số trang -->
                        @for ($i = 1; $i <= $feedbacks->lastPage(); $i++)
                            <li>
                                <a href="{{ $feedbacks->url($i) }}"
                                    class="inline-flex items-center justify-center {{ $feedbacks->currentPage() == $i ? 'bg-custom-500 text-white' : 'bg-white text-slate-500 border border-slate-200' }} rounded px-4 py-2 hover:bg-custom-50">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor

                        <!-- Nút Next -->
                        @if ($feedbacks->hasMorePages())
                            <li><a href="{{ $feedbacks->nextPageUrl() }}"
                                    class="inline-flex items-center justify-center bg-white text-slate-500 border border-slate-200 rounded px-4 py-2 hover:bg-custom-50">Next</a>
                            </li>
                        @else
                            <li><span
                                    class="disabled inline-flex items-center justify-center bg-gray-300 text-gray-500 border border-gray-200 rounded px-4 py-2">Next</span>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <!-- Modal -->
    <div id="feedbackModal" class="modal hidden">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Feedback Form</h3>
            </div>
            <div class="modal-body">
                <!-- Form bắt đầu từ đây -->
                <form id="feedbackForm">
                    <div class="form-group">
                        <label for="feedback-user">User</label>
                        <input type="text" id="feedback-user" name="user" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="feedback-beach">Beach</label>
                        <input type="text" id="feedback-beach" name="beach" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="feedback-rating">Rating</label>
                        <input type="number" id="feedback-rating" name="rating" class="form-control" min="1" max="5" required>
                    </div>

                    <div class="form-group">
                        <label for="feedback-message">Message</label>
                        <textarea id="feedback-message" name="message" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="feedback-date">Date</label>
                        <input type="text" id="feedback-date" name="date" class="form-control" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn submit-btn" onclick="submitFeedback()">Submit</button>
                <button class="btn close-btn" onclick="closeFeedbackModal()">Close</button>
            </div>
        </div>
    </div>

@endsection
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
                document.getElementById('feedback-beach').textContent = data.beach.name;
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
<style>
    /* Cấu hình modal */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6); /* Background tối */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        transition: opacity 0.3s ease;
    }

    /* Ẩn modal khi chưa hiển thị */
    .modal.hidden {
        display: none;
    }

    /* Nội dung của modal */
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        width: 50%; /* Chiều rộng modal là 50% màn hình */
        max-width: 600px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.3s ease;
    }

    /* Định dạng phần tiêu đề */
    .modal-header h3 {
        margin: 0;
        font-size: 1.25rem;
    }

    /* Định dạng phần form */
    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #3498db;
        outline: none;
    }

    /* Định dạng footer và các nút */
    .modal-footer {
        display: flex;
        justify-content: space-between;
        padding-top: 10px;
    }

    .btn {
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
    }

    .submit-btn {
        background-color: #28a745;
        color: white;
    }

    .submit-btn:hover {
        background-color: #218838;
    }

    .close-btn {
        background-color: #dc3545;
        color: white;
    }

    .close-btn:hover {
        background-color: #c82333;
    }

    /* Hiệu ứng khi modal xuất hiện */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
