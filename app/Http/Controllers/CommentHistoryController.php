<?php

namespace App\Http\Controllers;

use App\Models\Beach;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::guest() || Auth::user()->role_id != 2) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }

        // Lấy các giá trị tìm kiếm và lọc từ request
        $search = $request->input('search');
        $rating = $request->input('rating');

        // Truy vấn feedbacks với điều kiện tìm kiếm theo tên người dùng hoặc tên bãi biển và lọc theo số sao
        $feedbacks = Feedback::with('user', 'beach')
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('beach', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
                });
            })
            ->when($rating, function ($query) use ($rating) {
                return $query->where('rating', $rating);
            })
            ->paginate(10);

        // Trả về view với dữ liệu feedbacks đã được lọc và tìm kiếm
        return view('comments.index', compact('feedbacks'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $feedback = Feedback::with('user', 'beach')->findOrFail($id);

        return response()->json($feedback);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Tìm và xóa feedback
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        // Quay lại trang danh sách với thông báo
        return redirect()->route('comment-history.index')->with('success', 'Feedback deleted successfully.');
    }
}
