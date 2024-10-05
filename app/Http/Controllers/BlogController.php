<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDetail;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Display a listing of the blogs.
    public function index(Request $request) // Expecting the Request object
    {
        // Your logic here, e.g. retrieving blogs
        $blogs = Blog::paginate(10); // Adjust pagination as needed
        $totalBlogs = $blogs->total(); // This will give the total number of blogs in the paginated result

        return view('blogs.index', compact('blogs', 'totalBlogs'));
    }
    // Show the form for creating a new blog.
    public function create()
    {
        return view('blogs.create');
    }

    // Store a newly created blog in the database.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'description' => 'required',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $blog = Blog::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'image' => $imagePath,
            'description' => $validated['description'],
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
    }

    // Display the specified blog.
    public function show($id)
    {
        $blog = Blog::with('details')->findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    // Show the form for editing a blog.
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    // Update the specified blog in the database.
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'description' => 'required',
        ]);

        $blog = Blog::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $blog->image = $imagePath;
        }

        $blog->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    // Remove the specified blog from the database.
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
}
