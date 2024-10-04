<?php

namespace App\Http\Controllers;

use App\Models\Beach;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function index()
    {
        $beaches = Beach::orderBy('updated_at', 'desc')->take(5)->get();

        // Ghi lại hoặc cập nhật thông tin truy cập trong bảng visitor_logs
        VisitorLog::updateOrCreate(
            [
                'user_id' => Auth::check() ? Auth::id() : null, // Nếu người dùng đã đăng nhập
                'ip_address' => request()->ip(),                 // Lấy IP của người dùng hoặc khách
                'page_name' => 'home'
            ],
            [
                'visit_count' => DB::raw('visit_count + 1'),    // Tăng số lượng truy cập
                'updated_at' => now(),                          // Cập nhật thời gian hoạt động
            ]
        );
        $totalVisits = VisitorLog::count();

        // Đếm tổng số user online (user_id khác null)
        $userOnline = VisitorLog::whereNotNull('user_id')->count();

        // Đếm tổng số khách online (user_id là null)
        $guestOnline = VisitorLog::whereNull('user_id')->count();

        // Trả dữ liệu về view
        return view('index', compact('beaches', 'totalVisits', 'userOnline', 'guestOnline'));
    }

    public function logout()
    {
        // Xóa bản ghi khi người dùng logout
        if (Auth::check()) {
            VisitorLog::where('user_id', Auth::id())->delete();
        }

        Auth::logout();
        return redirect('/login');
    }

    public function about()
    {
        return view('about');
    }

    public function destination()
    {
        // Lấy tất cả các bãi biển từ database
        // $beaches = Beach::all();
        $beaches = Beach::with('feedbacks')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
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

        // Lấy các bãi biển và đếm số lượng đánh giá 5 sao
        $popularBeaches = Beach::withCount('feedbacks')
        ->withAvg('feedbacks', 'rating') // Tính toán điểm trung bình
        ->orderByDesc('feedbacks_avg_rating') // Sắp xếp theo điểm số trung bình trước
        ->orderByDesc('feedbacks_count') // Nếu điểm số trung bình giống nhau, sắp xếp theo số lượng đánh giá
        ->limit(3)
        ->get();

        // Trả dữ liệu về view chi tiết bãi biển, bao gồm cả dữ liệu đánh giá
        return view('destinationdetails', compact('beach', 'feedbacks', 'totalReviews', 'averageRating', 'ratingCount', 'popularBeaches'));
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
