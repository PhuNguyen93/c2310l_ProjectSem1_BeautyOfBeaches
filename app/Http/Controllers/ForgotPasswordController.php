<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Mail\SendOtpMail;

class ForgotPasswordController extends Controller
{
    // Hiển thị form quên mật khẩu
    public function showForgotForm()
    {
        return view('auth.passwords.email');
    }

    // Gửi OTP qua email để đặt lại mật khẩu
    public function sendOtpForReset(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Tìm user theo email
        $user = User::where('email', $request->email)->first();

        // Kiểm tra nếu email không tồn tại
        if (!$user) {
            return back()->withErrors(['email' => 'Email not registered']);
        }

        // Tạo mã OTP ngẫu nhiên
        $otp = rand(1000, 9999);

        // Cập nhật OTP trong cơ sở dữ liệu
        $user->otp = $otp;
        $user->save();

        // Gửi OTP qua email
        Mail::to($user->email)->send(new SendOtpMail($otp));

        // Lưu email và trạng thái OTP đã được gửi vào session
        session(['otp_sent' => true, 'email' => $request->email]);

        // Trả về thông báo rằng OTP đã được gửi
        return redirect()->back()->with('message', 'OTP đã được gửi tới email của bạn.');
    }

    // Xác minh OTP khi người dùng nhập OTP
    public function verifyResetOtp(Request $request)
    {
        // Validate OTP
        $request->validate([
            'otp' => 'required|numeric',
            'email' => 'required|email|exists:users,email',
        ]);

        // Tìm user theo email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }

        // Kiểm tra OTP
        if ($user->otp != $request->otp) {
            return back()->withErrors(['otp' => 'OTP code does not match']);
        }

        // OTP chính xác, xóa OTP để tránh tái sử dụng
        $user->otp = null;
        $user->save();

        // Xóa session OTP
        session()->forget('otp_sent');

        // Chuyển hướng người dùng tới trang đặt lại mật khẩu
        return redirect()->route('password.reset.form', ['email' => $user->email])
            ->with('message', 'OTP xác nhận thành công. Bạn có thể đặt lại mật khẩu.');
    }

    // Hiển thị form đặt lại mật khẩu sau khi OTP được xác thực
    public function showResetForm(Request $request)
    {
        // Kiểm tra nếu email có trong request
        $email = $request->input('email');
        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Không tìm thấy email.']);
        }

        return view('auth.passwords.reset', ['email' => $email]);
    }

    // Đặt lại mật khẩu mới
    public function resetPassword(Request $request)
    {
        // Validate mật khẩu mới
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:0|confirmed',
        ]);

        // Tìm user theo email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->password);
        $user->save();

        // Chuyển hướng sau khi đặt lại mật khẩu thành công
        return redirect()->route('login')->with('message', 'Mật khẩu của bạn đã được đặt lại thành công.');
    }
}
