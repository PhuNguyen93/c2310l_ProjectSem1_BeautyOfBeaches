<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendOtpMail;

class ForgotPasswordController extends Controller
{
    // Gửi OTP đến email của người dùng
    public function sendOtpForReset(Request $request)
    {
        // Xác thực email có tồn tại trong bảng users
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Tìm user theo email
        $user = User::where('email', $request->email)->first();

        // Tạo mã OTP ngẫu nhiên (4 số)
        $otp = rand(1000, 9999);

        // Cập nhật mã OTP cho user trong bảng users
        $user->otp = $otp;
        $user->save();

        // Gửi OTP qua email
        Mail::to($user->email)->send(new SendOtpMail($otp));

        // Lưu email vào session để sử dụng khi reset password
        session(['reset_email' => $request->email]);

        return redirect()->back()->with('otp_sent', true)->with('success', 'OTP đã được gửi đến email của bạn.');
    }

    // Xác thực OTP
    public function verifyOtp(Request $request)
    {
        // Xác thực dữ liệu từ form
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        // Lấy email từ session
        $email = session('reset_email');

        // Tìm user với email và mã OTP khớp
        $user = User::where('email', $email)->where('otp', $request->otp)->first();

        // Kiểm tra mã OTP có hợp lệ không
        if (!$user) {
            return redirect()->back()->with('error', 'Mã OTP không hợp lệ.');
        }

        // OTP hợp lệ, lưu trạng thái xác thực OTP vào session
        session(['otp_verified' => true]);

        return redirect()->back()->with('otp_verified', true)->with('success', 'OTP hợp lệ. Vui lòng đặt lại mật khẩu.');
    }

    // Xử lý việc reset mật khẩu
    public function resetPassword(Request $request)
    {
        // Xác thực mật khẩu
        $request->validate([
            'new_password' => 'required|min:0',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Lấy email từ session
        $email = session('reset_email');

        // Tìm user theo email
        $user = User::where('email', $email)->first();

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);
        $user->otp = null; // Xóa OTP sau khi sử dụng
        $user->save();

        // Xóa các session liên quan
        session()->forget(['reset_email', 'otp_verified']);

        return redirect()->route('login')->with('success', 'Mật khẩu đã được cập nhật thành công.');
    }
}
