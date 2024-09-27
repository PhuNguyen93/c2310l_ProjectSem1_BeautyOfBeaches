<?php

use App\Http\Controllers\BeachController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;

// Routes for HomeController
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/destination', 'destination')->name('destination');
    Route::get('/destinationdetails/{id}', 'destinationdetails')->name('destinationdetails');  // Đảm bảo route này chỉ có 1
    Route::get('/tour', 'tour')->name('tour');
    Route::get('/tourdetails', 'tourdetails')->name('tourdetails');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/blogdetails', 'blogdetails')->name('blogdetails');
    Route::get('/contact', 'contact')->name('contact');
});

// Search route
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Login and Register Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::controller(RegisterController::class)->group(function () {
    Route::get('register', function () {
        return view('auth.register'); // Hiển thị form đăng ký
    })->name('register');
    Route::post('register', 'store')->name('register.store');
});

//Account and Profile Routes
// Route::middleware(['auth'])->group(function () {
//     Route::get('/account', function () {
//         return view('pages-account');
//     });

//     Route::get('/account-settings', function () {
//         return view('pages-account-settings');
//     });

//     Route::resource('users', UserController::class );
//     Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
//     // Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');
// });

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');

Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::post('/users/change-password', [UserController::class, 'changePassword'])->name('users.changePassword');
// Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/profile/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.upload_avatar');
Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{id}/updateProfile', [ProfileController::class, 'showUpdateForm'])->name('profile.showUpdateForm');
// Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');


// Feedback Routes
Route::post('/beaches/{beach}/feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');
Route::delete('/feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');
Route::get('/feedbacks/{id}/edit', [FeedbackController::class, 'edit'])->name('feedbacks.edit');
Route::put('/feedbacks/{id}', [FeedbackController::class, 'update'])->name('feedbacks.update');
Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');


Route::get('/account', [UserController::class, 'account'])->name('account');
Route::get('/account/{id}', [UserController::class, 'show'])->name('account.show');


//beaches
Route::resource('beaches', BeachController::class);

// dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::resource('users', UserController::class);
Route::get('/account-settings/{id}', [UserController::class, 'showProfile'])->name('account-settings');

Route::post('/account-settings/{id}/upload-avatar', [UserController::class, 'uploadAvatar'])->name('User.upload_avatar');
Route::put('/account-settings/{id}/update_user', [UserController::class, 'update'])->name('users.update');
