<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function indexUser()
    {

        $blogs = Blog::orderBy('created_at', 'desc')->paginate(5);

        // Trả dữ liệu về view blog.blade.php
        return view('blogs.blog', compact('blogs'));
    }

    // Display a listing of the blogs.
    public function index(Request $request)
    {
        if (Auth::guest() || Auth::user()->role_id != 2) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }
        $search = $request->input('search');

        $blogs = Blog::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc') // Sắp xếp theo thứ tự giảm dần của ngày tạo
            ->paginate(5); // Hiển thị 5 bài trên mỗi trang

        return view('blogs.index', compact('blogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/assets/blogs');
            $imageUrl = str_replace('public/', 'storage/', $imagePath); // Đường dẫn đến ảnh
        } else {
            $imageUrl = null;
        }

        // Lưu blog
        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $imageUrl,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('blogs.index', ['page' => 1])->with('success', 'Blog added successfully');
    }
    public function destroy($id)
    {
        // Tìm bài viết theo ID
        $blog = Blog::findOrFail($id);

        // Xóa bài viết
        $blog->delete();

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
}
