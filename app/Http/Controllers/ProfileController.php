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
        if (Auth::user()->role_id != 1) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }
        // Truyền thông tin user vào view
        // dd($user->birth_date);
        return view('profile.profile', ['user' => $user]);
    }

    public function edit($id)
    {

        $user = User::findOrFail($id);
        return view('profile.profile.edit', compact('user')); // Chuyển đến view chỉnh sửa
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'name' => ['required','string', 'max:255', Rule::unique('users')->ignore($id) ],
            'country' => 'required|string|max:255',
            'phone' => ['required','string','max:10','regex:/^[0-9]+$/',Rule::unique('users')->ignore($id),],
           'email' => [ // Thêm xác thực cho email
            'nullable', // Cho phép email là null
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($id), // Kiểm tra email duy nhất, bỏ qua user hiện tại
        ],
        ]);
        // dd($request);
        $user = User::findOrFail($id);
        // dd($user);
        // dd($user);
        // Cập nhật thông tin người dùng
        // $user = User::findOrFail($id);
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->birth_date = $request->input('birth_date');
        $user->country = $request->input('country');
        $user->save();

        return redirect()->route('profile', ['id' => $user->id]);
        // return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
    public function uploadAvatar(Request $request)
        {

            // dd($request->file);
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Giới hạn kích thước file nếu cần
            ]);
            // dd($request);

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path('assets/images/Avatar'), $filename);

                // Cập nhật đường dẫn trong cơ sở dữ liệu
                $user = Auth::user();
                $user->img = 'assets/images/Avatar/' . $filename;

                $user->save();

                return back()->with('success', 'Avatar updated successfully.');
            }


            return back()->withErrors('Error uploading image.');
        }

    public function showUpdateForm($id)
        {
        // Lấy thông tin người dùng dựa trên $id
            $user = User::findOrFail($id);
            if (Auth::user()->role_id != 1) {
                return redirect()->route('index')->with('error', 'You do not have the required permissions.');
            }
            // Truyền thông tin user vào view
            // dd($user->birth_date);
            return view('profile.updateProfile', ['user' => $user]);
        }

        public function changePassword(Request $request)
        {
            // Validate input
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|string|min:0|confirmed', // Thay đổi độ dài tối thiểu thành 6
            ]);

            // Lấy thông tin user hiện tại
            $user = Auth::user();

            // Kiểm tra mật khẩu cũ
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Old password is incorrect.']);
            }

            // Tạo OTP
            $otp = rand(1000, 9999);
             // Tạo số OTP ngẫu nhiên 6 chữ số

            // Lưu OTP vào session
            $request->session()->put('otp', $otp);
            $request->session()->put('new_password', $request->new_password); // Lưu mật khẩu mới tạm thời

            // Gửi OTP qua email
            Mail::to($user->email)->send(new OtpMail($otp));

            // Chuyển hướng đến trang nhập OTP
            return redirect()->route('enter.otp', ['id' => $user->id]);
        }

    public function verifyOtp(Request $request)
{
    // Kiểm tra OTP
    $request->validate([
        'otp' => 'required|integer',
    ]);

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
    // Kiểm tra quyền truy cập, nếu cần
    if (Auth::user()->role_id != 1) {
        return redirect()->route('index')->with('error', 'You do not have the required permissions.');
    }

    return view('auth.enter-otp', ['userId' => $id]); // Chuyển ID vào view nếu cần
}


}
