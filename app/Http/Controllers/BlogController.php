<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetail;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Display a listing of the blogs.
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Thay thế 'Beach' bằng 'Blog'
        $blogs = Blog::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('blogs.blog', compact('blogs'));
    }
}
