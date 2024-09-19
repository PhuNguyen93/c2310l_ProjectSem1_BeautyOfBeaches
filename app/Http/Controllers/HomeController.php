<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    
    public function index2()
    {
        return view('index2');
    }

    public function index3()
    {
        return view('index3');
    }

    public function about()
    {
        return view('about');
    }

    public function destination()
    {
        return view('destination');
    }

    public function destinationdetails()
    {
        return view('destinationdetails');
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
