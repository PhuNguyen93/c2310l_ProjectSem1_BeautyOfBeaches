<?php

namespace App\Http\Controllers;

use App\Models\Beach;
use App\Models\BeachGallery;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeachController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::guest() || Auth::user()->role_id != 2) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }

        $search = $request->input('search');

        $beaches = Beach::where('status', 1)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('beaches.index', compact('beaches'));
    }

    public function create()
    {
        return view('beaches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'location' => 'nullable|max:255',
            'country' => 'nullable|max:255',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Multiple images
        ]);

        $data = $request->all();
        $beach = Beach::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'location' => $data['location'],
            'country' => $data['country'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
        ]);

        // Xử lý lưu hình ảnh
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $index => $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('assets/images/beaches'), $imageName);

                if ($index === 0) {
                    // Lưu ảnh đầu tiên làm ảnh bìa
                    $beach->image_url = 'assets/images/beaches/' . $imageName;
                    $beach->save();
                } else {
                    // Lưu các ảnh còn lại vào bảng BeachImage (nếu có bảng này)
                    BeachGallery::create([
                        'beach_id' => $beach->id,
                        'image_url' => 'assets/images/beaches/' . $imageName,
                    ]);
                }
            }
        }

        return redirect()->route('beaches.index')->with('success', 'Beach added successfully.');
    }


    public function storePdf(Request $request, Beach $beach)
    {
        // Validate the PDF file
        $request->validate([
            'pdf_file' => 'required|file|mimes:pdf|max:10000', // Max 10MB
        ]);

        // Process and save the PDF file
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Create a unique file name
            $file->move(public_path('assets/pdfs'), $fileName);  // Save the file to the public directory

            // Check if there is already a PDF file associated with the beach
            if ($beach->download) {
                // If there is a file, delete the old one from the public directory
                if (file_exists(public_path($beach->download->file_url))) {
                    unlink(public_path($beach->download->file_url)); // Delete the old file
                }

                // Update the existing download record with the new file info
                $beach->download->update([
                    'file_name' => $fileName,
                    'file_url' => 'assets/pdfs/' . $fileName,
                ]);
            } else {
                // If no previous PDF, create a new record in the downloads table
                Download::create([
                    'file_name' => $fileName,
                    'file_url' => 'assets/pdfs/' . $fileName,
                    'beach_id' => $beach->id,  // Associate the PDF with the beach
                ]);
            }
        }
        // Redirect to the same page with a success message
        return redirect()->back()->with('success', 'PDF file has been successfully added.');
    }
    public function deletePdf(Download $download)
    {
        // Xóa file từ thư mục public
        if (file_exists(public_path($download->file_url))) {
            unlink(public_path($download->file_url)); // Xóa file từ hệ thống
        }

        // Xóa bản ghi từ cơ sở dữ liệu
        $download->delete();

        // Chuyển hướng về trang hiện tại với thông báo thành công
        return redirect()->back()->with('success', 'PDF file deleted successfully.');
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
        'longitude' => 'nullable|numeric',
        'latitude' => 'nullable|numeric',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate cho các ảnh phụ
    ]);

    $data = $request->all();

    // Xử lý upload hình ảnh chính (Main Image)
    if ($request->hasFile('image_url')) {
        if ($beach->image_url && file_exists(public_path($beach->image_url))) {
            unlink(public_path($beach->image_url));
        }
        $imageName = time() . '.' . $request->file('image_url')->extension();
        $request->file('image_url')->move(public_path('assets/images/beaches'), $imageName);
        $data['image_url'] = 'assets/images/beaches/' . $imageName;
    }

    // Cập nhật các thông tin khác của biển
    $beach->update($data);

    // Xử lý cập nhật hình ảnh phụ (gallery)
    if ($request->hasFile('gallery')) {
        // Xóa các hình ảnh phụ cũ
        foreach ($beach->gallery as $gallery) {
            if (file_exists(public_path($gallery->image_url))) {
                unlink(public_path($gallery->image_url));
            }
            $gallery->delete(); // Xóa bản ghi trong bảng beach_galleries
        }

        // Lưu các hình ảnh phụ mới
        foreach ($request->file('gallery') as $image) {
            $galleryImageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('assets/images/beaches/galleries'), $galleryImageName);

            // Thêm bản ghi mới vào bảng beach_galleries
            $beach->gallery()->create([
                'image_url' => 'assets/images/beaches/galleries/' . $galleryImageName,
                'caption' => $image->getClientOriginalName(),
            ]);
        }
    }

    return redirect()->route('beaches.index')->with('success', 'Beach updated successfully.');
}

    public function search(Request $request)
    {
        $query = Beach::query();
        $query = Beach::where('status', 1);
        // Kiểm tra và lọc theo quốc gia
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        // Kiểm tra và lọc theo hướng (nếu có)
        if ($request->filled('direction')) {
            $query->where('direction', $request->direction);
        }

        // Lấy danh sách bãi biển với phân trang
        $beaches = $query->paginate(10);

        // Kiểm tra xem yêu cầu là AJAX không
        if ($request->ajax()) {
            return view('partials.beach_results', compact('beaches'));
        }

        // Trả về view đầy đủ nếu không phải yêu cầu AJAX
        // $countries = Country::all();
        return view('destination', compact('beaches', 'countries'));
    }

    public function bin(Request $request)
    {
        if (Auth::guest() || Auth::user()->role_id != 2) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }

        $search = $request->input('search');

        $beaches = Beach::where('status', 0)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('beaches.bin', compact('beaches'));
    }

    public function destroybin(Beach $beach)
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

        return redirect()->route('beaches.bin')->with('success', 'Beach cleared successfully.');
    }

    public function destroy(Beach $beach)
    {
        $beach->status = 0;
        $beach->save();

        return redirect()->route('beaches.index')->with('success', 'The beach has been trashed.');
    }

    public function restore(Beach $beach)
    {
        $beach->status = 1;
        $beach->save();

        // dd(1);
        return redirect()->route('beaches.bin')->with('success', 'The beach has been restored.');
    }
}
