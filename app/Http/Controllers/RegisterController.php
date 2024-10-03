<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // public function store(Request $request)
    // {

    //     // Validate dữ liệu đầu vào
    //     $request->validate([
    //         'name' => 'required|string|max:255|unique:users',
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^[A-Za-z0-9]+@gmail\.com$/'],
    //         'password' => 'required|string|confirmed',
    //     ]);


    //     //  dd( $request->role_id);
    //     // Lưu user vào database
    //         // 'password' => 'required|string|min:8|confirmed',

    //     // Lưu user vào database'
    //     // dd($request);
    //     User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role_id' => $request->role_id, // Sử dụng giá trị từ form
    //     ]);
    //     // Redirect về trang đăng nhập
    //     return redirect()->route('login')->with('success', 'Registration successful.');
    // }

    public function registerWithPhone(Request $request)
    {
        // Validation cho số điện thoại

        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'phone' => 'required|string|unique:users,phone', // Kiểm tra số điện thoại
            'password' => 'required|string|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone, // Lưu số điện thoại
            'email' => null, // Đặt giá trị email là null
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful.');
    }
    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'name' => 'required|string|max:255',
        'password' => 'required|confirmed|min:0',
    ]);

    // Create OTP
    $otp = rand(1000, 9999);

    // Store data including OTP
    session([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),  // Lưu mật khẩu đã mã hóa
        'otp' => $otp,
        'role_id' => $request->role_id,
    ]);
    session(['otp' => $otp]);
    // Send OTP to email
    Mail::to($request->email)->send(new OtpMail($otp));

    return redirect()->route('res.verify.form');
}

// Method to verify OTP
public function verifyOtp(Request $request)
{
    // Kiểm tra OTP
    // dd($request);

    // dd(session('otp'));
    if ($request->otp == session('otp')) {
        // Tạo tài khoản nếu OTP đúng

        // dd(session('name'));
        User::create([
            'name' => session('name'),
            'email' => session('email'),
            'password' => session('password'),
            'role_id' => session('role_id'),
            'status' => 'Verified',
        ]);
        // dd(4);
        // Xóa session sau khi xác thực
        session()->forget(['name', 'email', 'password', 'role_id', 'otp']);

        // Chuyển hướng đến trang đăng nhập với thông báo thành công
        return redirect()->route('login')->with('otp_success', 'Account created successfully! Please login.');
    }

    // Trả về lỗi nếu OTP sai
    return back()->withErrors(['otp' => 'Invalid OTP']);
}



    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }



 // Phương thức resendOtp để gửi lại mã OTP
 public function resendOtp(Request $request)
 {
     // Lấy email của người dùng từ session
     $email = session('email');

     // Kiểm tra nếu email không tồn tại trong session
     if (!$email) {
         return redirect()->back()->withErrors(['email' => 'Email not found in session.']);
     }

     // Tạo mã OTP mới
     $otp = rand(1000, 9999); // 6 chữ số ngẫu nhiên

     // Cập nhật mã OTP vào session
     session(['otp' => $otp]);

     // Gửi OTP qua email
     try {
         Mail::to($email)->send(new OtpMail($otp));
     } catch (\Exception $e) {
         return redirect()->back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
     }

     // Trả về thông báo thành công
     return redirect()->back()->with('success', 'OTP has been resent to your email.');
 }

}
