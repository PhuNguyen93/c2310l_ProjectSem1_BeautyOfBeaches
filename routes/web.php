<?php

use App\Http\Controllers\BeachController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentHistoryController;
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
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;

// Routes for HomeController
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/destination', 'destination')->name('destination');
    Route::get('/destinationdetails/{id}', 'destinationdetails')->name('destinationdetails'); // Đảm bảo route này chỉ có 1
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

// Register routes
Route::controller(RegisterController::class)->group(function () {
    Route::get('register', function () {
        return view('auth.register'); // Hiển thị form đăng ký
    })->name('register');
    Route::post('register', 'store')->name('register.store');
});

// Account and Profile Routes (có middleware auth)
// Route::middleware(['auth'])->group(function () {
//     Route::get('/account', function () {
//         return view('pages-account');
//     });

//     Route::get('/account-settings/{id}', [UserController::class, 'showProfile'])->name('account-settings');
//     Route::put('/account-settings/{id}/update_user', [UserController::class, 'update'])->name('users.update_user');

//     Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    // Route::post('/profile/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.upload_avatar');
    // Route::get('/profile/{id}/updateProfile', [ProfileController::class, 'showUpdateForm'])->name('profile.showUpdateForm');
// });

// Feedback Routes
Route::post('/beaches/{beach}/feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');
Route::delete('/feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');
Route::get('/feedbacks/{id}/edit', [FeedbackController::class, 'edit'])->name('feedbacks.edit');
Route::put('/feedbacks/{id}', [FeedbackController::class, 'update'])->name('feedbacks.update');
Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');
Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');

// Beaches routes
Route::resource('beaches', BeachController::class);

// OTP Routes
Route::get('otp/verify', [UserController::class, 'showOtpForm'])->name('otp.verify.form');
Route::post('otp/verify', [UserController::class, 'verifyOtp'])->name('otp.verify');

// Hiển thị form nhập OTP và xác thực OTP
Route::get('verify-otp', [UserController::class, 'showOtpForm'])->name('verify.otp.form');
Route::post('verify-otp', [UserController::class, 'verifyOtp'])->name('verify.otp');

// Resource controller for users
Route::resource('users', UserController::class);






// profile (Lam Xuan Hung)

Route::post('/profile/upload-avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.upload_avatar');
Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{id}/updateProfile', [ProfileController::class, 'showUpdateForm'])->name('profile.showUpdateForm');

// Dashboard (Lam Xuan Hung)

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::post('/users/change-password', [UserController::class, 'changePassword'])->name('users.changePassword');
Route::get('/account', [UserController::class, 'account'])->name('account');
Route::get('/account/{id}', [UserController::class, 'show'])->name('account.show');
Route::resource('users', UserController::class);
Route::get('/account-settings/{id}', [UserController::class, 'showProfile'])->name('account-settings');
Route::post('/account-settings/{id}/upload-avatar', [UserController::class, 'uploadAvatar'])->name('User.upload_avatar');
Route::put('/account-settings/{id}/update_user', [UserController::class, 'update'])->name('users.update');
// -------(lam Xuan Hung)------------------------------------

// user_comment
Route::delete('/feedbacks/{feedback}', [CommentController::class, 'destroy'])->name('feedbacks.comment.destroy');
Route::get('/feedbacks/{id}', [CommentController::class, 'show'])->name('feedbacks.comment.show');

// Route hiển thị trang profile và bình luận
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

// Route để lọc bình luận theo số sao
Route::get('/user/{id}/filter-feedback', [UserController::class, 'filterFeedback'])->name('user.filterFeedback');


// Route resend OTP
Route::get('/resend-otp', [UserController::class, 'resendOtp'])->name('resend.otp');

Route::post('/register/phone', [RegisterController::class, 'registerWithPhone'])->name('register.phone'); // Route cho số điện thoại


//comment history
Route::resource('comment-history', CommentHistoryController::class);
Route::get('/comment-history/{id}', [CommentHistoryController::class, 'show']);

Route::post('/profile/{id}/updateProfile/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
// Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
Route::get('/profile/{id}/updateProfile/change-password/enter-otp', [ProfileController::class, 'enterOtp'])->name('enter.otp'); // Route cho trang nhập OTP
Route::post('/verify-otp', [ProfileController::class, 'Pro_verifyOtp'])->name('verifyPro');

// Hiển thị form forgot password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');

})->name('forgot-password');
// Gửi OTP
Route::post('/send-otp-reset', [ForgotPasswordController::class, 'sendOtpForReset'])->name('sendOtpForReset');
// Xác thực OTP
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verifyOtp');
// Reset mật khẩu
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');
//  Profile Controller
Route::get('/register/verify', [RegisterController::class, 'showOtpForm'])->name('res.verify.form');
Route::post('/register/verify', [RegisterController::class, 'verifyOtp'])->name('res.verify');
Route::get('/register/resend-otp', [RegisterController::class, 'resendOtp'])->name('resend.res');
