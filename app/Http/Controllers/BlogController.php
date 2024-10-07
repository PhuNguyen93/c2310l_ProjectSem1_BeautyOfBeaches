<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // Display a listing of the blogs.
    public function index(Request $request)
    {
        $search = $request->input('search');

        $user = Auth::user();

        $blogs = Blog::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('blogs.blog', compact('blogs','user'));
    }

    public function store(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Xử lý lưu hình ảnh
    $imagePath = $request->file('image')->store('assets/images/blogs', 'public');

    // Tạo bài viết mới
    Blog::create([
        'user_id' => Auth::id(), // Lưu ID của người dùng hiện tại
        'title' => 'New Post', // Bạn có thể thay đổi hoặc thêm trường title
        'description' => $request->description,
        'image_url' => $imagePath,
    ]);

    return redirect()->route('blog')->with('success', 'Bài viết đã được đăng thành công!');
}
}
