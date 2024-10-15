<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetail;
use App\Models\BlogFeedback;
use App\Models\BlogImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function showDetail($id)
    {
        $blog = Blog::with('images', 'feedbacks.user')->findOrFail($id);
        $popularBlogs = $this->getPopularBlogs();

        return view('blogs.blogdetails', compact('blog', 'popularBlogs'));
    }


    public function indexUser(Request $request)
    {
        $search = $request->input('search');

        $blogs = Blog::where('status', 1)
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $popularBlogs = $this->getPopularBlogs();

        return view('blogs.blog', compact('blogs', 'popularBlogs', 'search'));
    }

    public function index(Request $request)
    {
        // dd(1);
        if (Auth::guest() || Auth::user()->role_id != 2) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }
        $search = $request->input('search');

        $blogs = Blog::where('status', '!=', 0)
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        return view('blogs.index', compact('blogs'));
    }
    public function approve($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = 1; // approved
        $blog->save();

        return redirect()->back()->with('success', 'Blog approved successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mainImageUrl = null;

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            $mainImagePath = $images[0]->store('public/assets/blogs');
            $mainImageUrl = str_replace('public/', 'storage/', $mainImagePath);

            $blog = Blog::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
                'image_url' => $mainImageUrl,
            ]);

            foreach ($images as $key => $image) {
                if ($key > 0) {
                    $imagePath = $image->store('public/assets/blogs');
                    $imageUrl = str_replace('public/', 'storage/', $imagePath);

                    BlogImage::create([
                        'blog_id' => $blog->id,
                        'image_url' => $imageUrl,
                    ]);
                }
            }
        }
        return redirect()->route('admin.blog')->with('success', 'Blog added successfully');
    }

    public function storeBlog(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create a blog post.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mainImageUrl = null;

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            $mainImagePath = $images[0]->store('public/assets/blogs');
            $mainImageUrl = str_replace('public/', 'storage/', $mainImagePath);

            $status = (Auth::user()->role_id == 2) ? 1 : 2;

            $blog = Blog::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
                'image_url' => $mainImageUrl,
                'status' => $status, //pending
            ]);

            foreach ($images as $key => $image) {
                if ($key > 0) {
                    $imagePath = $image->store('public/assets/blogs');
                    $imageUrl = str_replace('public/', 'storage/', $imagePath);

                    BlogImage::create([
                        'blog_id' => $blog->id,
                        'image_url' => $imageUrl,
                    ]);
                }
            }
        }
        return redirect()->route('user.blog')->with('success', 'Blog has been added and is pending approval.');
    }

    public function showBlogComments(Request $request)
    {
        $search = $request->input('search');
        $rating = $request->input('rating');

        $feedbacks = BlogFeedback::when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('comment', 'like', "%{$search}%");
        })->when($rating, function ($query, $rating) {
            $query->where('rating', $rating);
        })->paginate(5);

        return view('blog-comments.index', compact('feedbacks'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        if (Auth::user()->id !== $blog->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this blog post.');
        }

        $blog->title = $request->title;
        $blog->description = $request->description;

        // Cập nhật hình ảnh chính
        if ($request->hasFile('image_url')) {
            $mainImagePath = $request->file('image_url')->store('public/assets/blogs');
            $mainImageUrl = str_replace('public/', 'storage/', $mainImagePath);
            $blog->image_url = $mainImageUrl;
        }

        $blog->save();

        // Cập nhật hình ảnh phụ
        if ($request->hasFile('images')) {
            $blog->images()->delete();

            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('public/assets/blogs');
                $imageUrl = str_replace('public/', 'storage/', $imagePath);

                BlogImage::create([
                    'blog_id' => $blog->id,
                    'image_url' => $imageUrl,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Blog post updated successfully');
    }
    public function destroyBlogComment($id)
    {
        $feedback = BlogFeedback::findOrFail($id);
        $feedback->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    public function destroyBlog($id)
    {
        $blog = Blog::findOrFail($id);

        if (Auth::user()->id !== $blog->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this blog post.');
        }

        $blog->delete();

        return redirect()->route('user.blog')->with('success', 'Blog post deleted successfully');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        // $blog->delete();
        $blog->status = 0;
        $blog->save();
        return redirect()->route('admin.blog')->with('success', 'Blog has been trashed');
    }
    public function permanentlyDelete($id)
    {
        // Tìm blog theo ID
        $blog = Blog::findOrFail($id);

        // Xóa vĩnh viễn blog
        $blog->forceDelete();

        return redirect()->back()->with('success', 'Blog deleted permanently successfully');
    }


    public function storeFeedback(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to comment.');
        }
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        BlogFeedback::create([
            'user_id' => Auth::id(),
            'blog_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);


        return redirect()->route('blogdetails', $id)->with('success', 'Feedback posted successfully.');
    }

    public function updateFeedback(Request $request, $feedbackId)
    {
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $feedback = BlogFeedback::findOrFail($feedbackId);

        // Kiểm tra nếu người dùng hiện tại là chủ của feedback
        if (Auth::id() !== $feedback->user_id) {
            return redirect()->back()->with('error', 'You are not allowed to edit this feedback.');
        }

        $feedback->update([
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Feedback updated successfully.');
    }

    public function deleteFeedback($feedbackId)
    {
        $feedback = BlogFeedback::findOrFail($feedbackId);

        // Kiểm tra nếu người dùng hiện tại là chủ của feedback
        if (Auth::id() !== $feedback->user_id) {
            return redirect()->back()->with('error', 'You are not allowed to delete this feedback.');
        }

        // Xóa feedback
        $feedback->delete();

        // Trả về trang trước đó và thông báo thành công
        return redirect()->back()->with('success', 'Feedback deleted successfully.');
    }

    public function getPopularBlogs()
    {
        // Lấy các blog với trung bình rating và sắp xếp theo rating trung bình, sau đó là số lượng đánh giá
        $popularBlogs = Blog::withCount(['feedbacks as avg_rating' => function ($query) {
            $query->select(DB::raw('coalesce(avg(rating),0)'));
        }, 'feedbacks as feedback_count' => function ($query) {
            $query->select(DB::raw('count(*)'));
        }])
            ->orderByDesc('avg_rating') // Sắp xếp theo điểm trung bình cao nhất
            ->orderByDesc('feedback_count') // Nếu điểm trung bình giống nhau thì sắp xếp theo số lượng đánh giá
            ->take(3) // Lấy 3 bài viết nhiều nhất
            ->get();

        return $popularBlogs;
    }

    public function bin(Request $request)
    {
        // Kiểm tra quyền truy cập
        if (Auth::guest() || Auth::user()->role_id != 2) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }

        // Tìm kiếm blog theo từ khóa (nếu có)
        $search = $request->input('search');

        // Truy vấn lấy các blog có status = 1 và áp dụng tìm kiếm
        $blogs = Blog::where('status', 0)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Trả về view cùng với biến $blogs
        return view('blogs.bin', compact('blogs'));
    }
    public function restore(Blog $blog)
    {
        $blog->status = 2;
        $blog->save();

        return redirect()->route('blog.bin')->with('success', 'The Blog has been restored.');
    }
}
