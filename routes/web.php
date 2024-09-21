<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\RouteController;
use App\Http\Controllers\LoginController;

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

