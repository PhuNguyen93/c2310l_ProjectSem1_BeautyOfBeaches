<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Beach;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    public function store(Request $request, Beach $beach)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
        ]);
        // Tạo feedback mới
        Feedback::create([
            'user_id' => Auth::id(),  // Lấy ID người dùng hiện tại
            'beach_id' => $beach->id,
            'rating' => $request->input('rating'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Thank you for rating!');
    }

    public function destroy($id)
    {
        // Tìm feedback theo ID
        $feedback = Feedback::findOrFail($id);

        // Kiểm tra quyền xóa: Người đăng bình luận hoặc admin
        if (Auth::id() !== $feedback->user_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa bình luận này.');
        }

        // Xóa feedback
        $feedback->delete();

        return redirect()->back()->with('success', 'Bình luận đã được xóa thành công.');
    }
}
