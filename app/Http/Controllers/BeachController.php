<?php

namespace App\Http\Controllers;

use App\Models\Beach;
use Illuminate\Http\Request;

class BeachController extends Controller
{
    /**
     * Hiển thị danh sách các bãi biển.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $beaches = Beach::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%{$search}%");
    })
    ->orderBy('created_at','desc')
    ->paginate(10);

    return view('beaches.index', compact('beaches'));
}

    /**
     * Hiển thị form tạo bãi biển mới.
     */
    public function create()
    {
        return view('beaches.create');
    }

    /**
     * Lưu bãi biển mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'location' => 'nullable|max:255',
            'country' => 'nullable|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Xử lý upload hình ảnh và lưu vào thư mục public
        if ($request->hasFile('image_url')) {
            $imageName = time() . '.' . $request->file('image_url')->extension();
            $request->file('image_url')->move(public_path('assets/images/beaches'), $imageName);
            $data['image_url'] = 'assets/images/beaches/' . $imageName; // Lưu đường dẫn vào database
        }

        Beach::create($data);

        return redirect()->route('beaches.index')->with('success', 'Đã thêm bãi biển thành công.');
    }

    /**
     * Hiển thị chi tiết một bãi biển cụ thể.
     */
    public function show(Beach $beach)
    {
        return view('beaches.show', compact('beach'));
    }

    /**
     * Hiển thị form chỉnh sửa bãi biển.
     */
    public function edit(Beach $beach)
    {
        return view('beaches.edit', compact('beach'));
    }

    /**
     * Cập nhật thông tin bãi biển trong cơ sở dữ liệu.
     */
    public function update(Request $request, Beach $beach)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'name' => 'required|max:255',
        'description' => 'nullable',
        'description2' => 'nullable',
        'description3' => 'nullable',
        'location' => 'nullable|max:255',
        'area_id' => 'nullable|exists:areas,id',
        'country' => 'nullable|max:255',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->all();

    // Xử lý upload hình ảnh mới
    if ($request->hasFile('image_url')) {
        // Xóa hình ảnh cũ nếu có
        if ($beach->image_url && file_exists(public_path($beach->image_url))) {
            unlink(public_path($beach->image_url));
        }

        // Lưu hình ảnh mới vào thư mục public/assets/images/beaches
        $imageName = time() . '.' . $request->file('image_url')->extension();
        $request->file('image_url')->move(public_path('assets/images/beaches'), $imageName);

        // Cập nhật đường dẫn hình ảnh mới vào database
        $data['image_url'] = 'assets/images/beaches/' . $imageName;
    }

    // Cập nhật các thông tin khác
    $beach->update($data);

    return redirect()->route('beaches.index')->with('success', 'Đã cập nhật bãi biển thành công.');
}

    /**
     * Xóa một bãi biển khỏi cơ sở dữ liệu.
     */
    public function destroy(Beach $beach)
{
    // Xóa tất cả các hình ảnh trong beach_galleries nếu có
    foreach ($beach->gallery as $gallery) {
        // Xóa hình ảnh từ thư mục public nếu có
        if ($gallery->image_url && file_exists(public_path($gallery->image_url))) {
            unlink(public_path($gallery->image_url));
        }
        // Xóa bản ghi trong gallery
        $gallery->delete();
    }

    // Xóa hình ảnh chính của bãi biển nếu có
    if ($beach->image_url && file_exists(public_path($beach->image_url))) {
        unlink(public_path($beach->image_url));
    }

    if ($beach->feedbacks) { // Kiểm tra xem feedbacks có tồn tại
        foreach ($beach->feedbacks as $comment) {
            $comment->delete();
        }
    }
    // Xóa bãi biển sau khi đã xóa các bản ghi liên quan
    $beach->delete();

    return redirect()->route('beaches.index')->with('success', 'Đã xóa bãi biển thành công.');
}
}
