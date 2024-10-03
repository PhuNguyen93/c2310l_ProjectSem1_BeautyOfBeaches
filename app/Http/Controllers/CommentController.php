<?php

namespace App\Http\Controllers;

use App\Models\Feedback; // Đảm bảo bạn đã import model Feedback
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function destroy($id)
    {
        $feedback = Feedback::find($id);

        if ($feedback) {
            $feedback->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }

        return redirect()->back()->with('error', 'Comment not found.');
    }
    public function show($id)
    {
        $feedback = Feedback::with('beach')->findOrFail($id); // Tải bình luận cùng với thông tin bãi biển

        return response()->json([
            'beach_name' => $feedback->beach->name,
            'user_name' => $feedback->user->name, // Nếu có mối quan hệ với người dùng
            'country' => $feedback->beach->country,
            'rating' => $feedback->rating,
            'message' => $feedback->message,
            'created_at' => $feedback->created_at,
        ]);
    }
}
