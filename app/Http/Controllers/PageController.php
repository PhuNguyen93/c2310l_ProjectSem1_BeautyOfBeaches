<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Trang chủ
    public function home()
    {
        return view('home');
    }

    // Trang About Us
    public function aboutUs()
    {
        return view('aboutUs');
    }

    // Trang Contact
    public function contact()
    {
        return view('contact');
    }

    // Trang Gallery
    public function gallery()
    {
        return view('gallery');
    }

    // Trang Beaches
    public function Beaches()
    {
        return view('beach');
    }
}
