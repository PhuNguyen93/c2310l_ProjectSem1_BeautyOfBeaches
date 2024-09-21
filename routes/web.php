<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;


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

Route::get("/dashboards-analytics", [RouteController::class, 'index'])->name('dashboards-analytics');

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
