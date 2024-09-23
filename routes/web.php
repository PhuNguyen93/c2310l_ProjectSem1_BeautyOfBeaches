<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\RouteController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;

Route::controller(HomeController::class)->group(function () {
Route::get('/', 'index')->name('index');
Route::get('/index', 'index')->name('index');
Route::get('/index2', 'index2')->name('index2');
Route::get('/index3', 'index3')->name('index3');
Route::get('/about', 'about')->name('about');
Route::get('/destination','destination')->name('destination');
Route::get('/destinationdetails','destinationdetails')->name('destinationdetails');
Route::get('/tour','tour')->name('tour');
Route::get('/tourdetails','tourdetails')->name('tourdetails');
Route::get('/blog','blog')->name('blog');
Route::get('/blogdetails','blogdetails')->name('blogdetails');
Route::get('/contact','contact')->name('contact');

});

Route::get('/destinationdetails/{id}', [HomeController::class, 'destinationdetails'])->name('destinationdetails');
//


Route::get("/dashboards-analytics", [RouteController::class, 'index'])->name('  ');


Route::controller(LoginController::class) -> group(function(){
    Route::get('/login','showLoginForm')->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});


Route::controller(RegisterController::class) -> group(function(){
    Route::get('register', function () {
        return view('auth.register'); // Hiển thị form đăng ký
    })->name('register');

    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
});

Route::get('/account', function () {
    return view('pages-account');
});

Route::get('/account-settings', function () {
    return view('pages-account-settings');
});

// Trong file routes/web.php
Route::get('/users', [UserController::class, 'index']);
// Định nghĩa route cho trang danh sách người dùng
Route::resource('users', UserController::class);


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');
