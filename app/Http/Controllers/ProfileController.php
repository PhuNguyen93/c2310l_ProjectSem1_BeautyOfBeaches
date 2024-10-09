<?php
namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    public function show($id)
    {
        // Lấy thông tin người dùng dựa trên $id
        $user = User::findOrFail($id);

        // Kiểm tra quyền hạn
        if (Auth::user()->role_id != 1) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }

        // Truyền thông tin user vào view
        return view('profile.profile', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required','string', 'max:255', Rule::unique('users')->ignore($id)],
            'country' => 'required|string|max:255',
            'phone' => ['required','string','max:10','regex:/^[0-9]+$/',Rule::unique('users')->ignore($id)],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
        ]);

        // Lấy thông tin người dùng
        $user = User::findOrFail($id);

        // Cập nhật thông tin người dùng
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->birth_date = $request->input('birth_date');
        $user->country = $request->input('country');
        $user->save();

        return redirect()->route('profile', ['id' => $user->id])->with('success', 'Profile updated successfully');
    }

    public function uploadAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('assets/images/Avatar'), $filename);

        // Cập nhật đường dẫn trong cơ sở dữ liệu
        $user = Auth::user();
        $user->img = 'assets/images/Avatar/' . $filename;
        $user->save();

        // Redirect về trang profile với thông báo thành công
        return redirect()->route('profile', ['id' => $user->id])->with('success', 'Avatar updated successfully.');
    }

    return back()->withErrors('Error uploading image.');
}


    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // Lấy thông tin user hiện tại
        $user = Auth::user();

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect.']);
        }

        // Tạo OTP
        $otp = rand(1000, 9999);

        // Lưu OTP và mật khẩu mới vào session
        $request->session()->put('otp', $otp);
        $request->session()->put('new_password', $request->new_password);

        // Gửi OTP qua email
        Mail::to($user->email)->send(new OtpMail($otp));

        return redirect()->route('enter.otp', ['id' => $user->id]);
    }

    public function Pro_verifyOtp(Request $request)
    {
        // Kiểm tra OTP
        $request->validate([
            'otp' => 'required|integer',
        ]);

        // Kiểm tra xem OTP có khớp với giá trị lưu trong session không
        if ($request->otp == session('otp')) {
            // Cập nhật mật khẩu mới
            $user = Auth::user();
            $user->password = Hash::make(session('new_password'));
            $user->save();

            // Xóa session sau khi xác thực
            $request->session()->forget(['otp', 'new_password']);

            // Redirect với thông báo thành công
            return redirect()->route('profile', ['id' => $user->id])->with('success', 'Password changed successfully.');
        }

        // Trả về lỗi nếu OTP sai
        return back()->withErrors(['otp' => 'Invalid OTP']);
    }


    public function enterOtp($id)
    {
        // Kiểm tra quyền truy cập
        if (Auth::user()->role_id != 1) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }

        return view('auth.enter-otp', ['userId' => $id]);
    }
}
