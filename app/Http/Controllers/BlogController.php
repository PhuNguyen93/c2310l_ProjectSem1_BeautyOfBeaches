<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetail;
use App\Models\BlogImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function showDetail($id)
    {
        // Lấy thông tin blog cùng với các hình ảnh phụ
        $blog = Blog::with('images')->findOrFail($id);

        // Trả dữ liệu về view blogdetails.blade.php
        return view('blogs.blogdetails', compact('blog'));
    }

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
        // Validate dữ liệu nhập vào
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Hình ảnh chính hoặc phụ
        ]);

        // Khởi tạo biến để lưu ảnh chính
        $mainImageUrl = null;

        // Kiểm tra nếu có hình ảnh được tải lên
        if ($request->hasFile('images')) {
            // Lấy tất cả các hình ảnh được tải lên
            $images = $request->file('images');

            // Lấy hình ảnh đầu tiên làm ảnh chính
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
        // Tìm bài viết theo ID
        $blog = Blog::findOrFail($id);

        // Xóa bài viết
        $blog->delete();

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
}
