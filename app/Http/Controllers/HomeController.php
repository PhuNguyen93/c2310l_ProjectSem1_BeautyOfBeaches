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
        $beaches = Beach::all();

        // Truyền danh sách bãi biển sang view 'destination'
        return view('destination', compact('beaches'));
    }

    public function destinationdetails($id)

    {
        // Lấy bãi biển theo ID
        $beach = Beach::with('gallery')->findOrFail($id);

        // Trả dữ liệu về view chi tiết bãi biển
        return view('destinationdetails', compact('beach'));
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
