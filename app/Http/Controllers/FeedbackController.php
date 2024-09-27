<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Beach;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);

        if (Auth::user()->id !== $feedback->user_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa comment này.');
        }

        return view('feedbacks.edit', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        if (Auth::user()->id !== $feedback->user_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa comment này.');
        }

        $request->validate([
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $feedback->message = $request->message;
        $feedback->rating = $request->rating;
        $feedback->save();

        return redirect()->back()->with('success', 'Comment đã được cập nhật.');
    }

    public function store(Request $request, Beach $beach)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'beach_id' => $beach->id,
            'rating' => $request->input('rating'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Thank you for rating!');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        if (Auth::id() !== $feedback->user_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa bình luận này.');
        }

        $feedback->delete();

        return redirect()->back()->with('success', 'Bình luận đã được xóa thành công.');
    }
}
