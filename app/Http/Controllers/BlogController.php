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

        return view('blogs.blogdetails', compact('blog','popularBlogs'));
    }

    public function indexUser()
    {

        $blogs = Blog::orderBy('created_at', 'desc')->paginate(5);

        return view('blogs.blog', compact('blogs'));
    }

    public function index(Request $request)
    {
        if (Auth::guest() || Auth::user()->role_id != 2) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }
        $search = $request->input('search');

        $blogs = Blog::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('blogs.index', compact('blogs'));
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

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
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

        return redirect()->route('blogdetails', $feedback->blog_id)->with('success', 'Feedback updated successfully.');
    }

    public function deleteFeedback($feedbackId)
    {
        $feedback = BlogFeedback::findOrFail($feedbackId);

        // Kiểm tra nếu người dùng hiện tại là chủ của feedback
        if (Auth::id() !== $feedback->user_id) {
            return redirect()->back()->with('error', 'You are not allowed to delete this feedback.');
        }

        $feedback->delete();

        return redirect()->route('blogdetails', $feedback->blog_id)->with('success', 'Feedback deleted successfully.');
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
}
