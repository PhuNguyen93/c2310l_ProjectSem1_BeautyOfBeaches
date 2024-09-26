<?php

namespace App\Http\Controllers;

use App\Models\Beach;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy tối đa 5 bãi biển mới nhất đã được cập nhật, sắp xếp theo ngày cập nhật gần nhất
        $beaches = Beach::orderBy('updated_at', 'desc')->take(5)->get();

        // Trả dữ liệu về view
        return view('index', compact('beaches'));
    }

    public function about()
    {
        return view('about');
    }

    public function destination()
    {
        // Lấy tất cả các bãi biển từ database
        // $beaches = Beach::all();
        $beaches = Beach::with('feedbacks')->paginate(10);
        // Truyền danh sách bãi biển sang view 'destination'
        return view('destination', compact('beaches'));
    }

    public function destinationdetails($id)
    {
        // Lấy bãi biển theo ID
        $beach = Beach::with('gallery')->findOrFail($id);

        // Lấy tất cả phản hồi (feedbacks) cho bãi biển này
        $feedbacks = \App\Models\Feedback::where('beach_id', $beach->id)->get();
        $totalReviews = $feedbacks->count(); // Tổng số người đánh giá
        $averageRating = $totalReviews > 0 ? round($feedbacks->avg('rating'), 1) : 0; // Điểm trung bình

        // Đếm số lượng đánh giá cho từng sao
        $ratingCount = [
            5 => $feedbacks->where('rating', 5)->count(),
            4 => $feedbacks->where('rating', 4)->count(),
            3 => $feedbacks->where('rating', 3)->count(),
            2 => $feedbacks->where('rating', 2)->count(),
            1 => $feedbacks->where('rating', 1)->count(),
        ];

        // Trả dữ liệu về view chi tiết bãi biển, bao gồm cả dữ liệu đánh giá
        return view('destinationdetails', compact('beach', 'feedbacks', 'totalReviews', 'averageRating', 'ratingCount'));
    }

    public function tour()
    {
        return view('tour');
    }

    public function tourdetails()
    {
        return view('tourdetails');
    }

    public function blog()
    {
        return view('blog');
    }

    public function blogdetails()
    {
        return view('blogdetails');
    }

    public function contact()
    {
        return view('contact');
    }
}
