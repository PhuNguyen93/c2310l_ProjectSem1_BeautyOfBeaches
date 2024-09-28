<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    // Hàm để hiển thị danh sách người dùng với phân trang
    public function index(Request $request)
{
    if (Auth::user()->role_id != 2) {
        return redirect()->route('index')->with('error', 'You do not have the required permissions.');
    }
    // Nhận các tham số từ yêu cầu
    $search = $request->input('search');
    $status = $request->input('status');

    // Bắt đầu truy vấn từ bảng users
    $query = User::query();

    // Nếu có giá trị search, tìm kiếm theo tên, email
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }

    // Lọc theo trạng thái nếu có
    if ($status) {
        $query->where('status', $status);
    }

    // Phân trang kết quả
    $users = $query->paginate(10);
    // dd(7);
    // Trả về view với dữ liệu người dùng
    return view('apps-users-list', compact('users'));
}

    // Hàm để hiển thị form tạo người dùng mới (nếu cần)
    public function create()
    {
        // Trả về view tạo người dùng
        return view('users.create');
    }

    // Hàm để lưu người dùng mới (với việc lấy ID người dùng vừa tạo)
    public function store(Request $request)
{
    // Kiểm tra xem email đã tồn tại chưa
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users,email',
        // Các trường khác
    ],[
        'email.unique' => 'Email này đã được sử dụng để đăng ký tài khoản. Vui lòng sử dụng email khác.',
    ]
);
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }


    // Gửi OTP nếu kiểm tra thành công
    $otp = rand(1000, 9999);
    session([   'otp' => $otp,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
            ]);

    // Gửi OTP qua email
    Mail::to($request->email)->send(new OtpMail($otp));

    // Chuyển hướng đến form xác minh OTP
    return redirect()->route('verify.otp.form')->with('success', 'OTP has been sent to your email.');
}



    public function edit($id)
    {
        $user = User::findOrFail($id);
        dd(1);
        return view('users.edit', compact('user'));
    }

   public function update(Request $request, $id)
{
    // dd(1);
    $request->validate([
        'name' => ['required','string','max:255',Rule::unique('users')->ignore($id) ],
        'country' => 'required|string|max:255',
        'phone' => ['string','max:10','regex:/^[0-9]+$/',Rule::unique('users')->ignore($id)],
    ]);
    // dd($request);
    $user = User::findOrFail($id);
    // dd($user);
    // Cập nhật thông tin người dùng
    // $user = User::findOrFail($id);
    $user->name = $request->input('name');
    $user->phone = $request->input('phone');
    $user->birth_date = $request->input('birth_date');
    $user->country = $request->input('country');
    $user->save();

    return redirect()->route('dashboard');
}

     // Hàm để xóa người dùng
     public function destroy($id)
{
    // Tìm người dùng theo ID
    $user = User::findOrFail($id);

    // Kiểm tra nếu vai trò của người dùng là admin
    if ($user->role_id == 2) { // 2 là role_id của admin
        // Điều hướng về trang danh sách người dùng với thông báo lỗi
        return redirect()->route('users.index')->with('error', 'Admin account cannot be deleted.');
    }

    // Xóa người dùng nếu không phải admin
    $user->delete();

    // Điều hướng về trang danh sách người dùng với thông báo thành công
    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
}

public function changePassword(Request $request)
{
    // Kiểm tra nếu người dùng đã xác thực
    if (!Auth::check()) {
        return redirect()->route('login')->withErrors(['error' => 'You must be logged in to change your password.']);
    }

    /** @var \App\Models\User $user */
    $user = Auth::user(); // Lấy user hiện tại

    // Validate yêu cầu
    $request->validate([
        'old_password' => 'required|string',
        'new_password' => 'required|string|min:0|confirmed', // Đảm bảo mật khẩu mới có độ dài tối thiểu
    ]);

    // Kiểm tra mật khẩu cũ
    if (!Hash::check($request->old_password, $user->password)) {
        return redirect()->back()->withErrors(['old_password' => 'The provided password does not match our records.']);
    }

    // Cập nhật mật khẩu mới
    $user->update(['password' => Hash::make($request->new_password)]); // Sử dụng phương thức update

    return redirect()->back()->with('status', 'Password changed successfully!');
}

public function account($id)
{
    // Lấy người dùng hiện tại
    // $user = Auth::user();
    $user = User::findOrFail($id);
    dd(3);
    // Truyền dữ liệu người dùng vào view
    return view('pages-account', compact('user'));
}

public function show($id)
{
    $user = User::findOrFail($id);

    return view('pages-account', compact('user'));
}

public function showProfile($id)
{

    // Lấy dữ liệu của user với ID nhất định
    $user = User::find($id);
    // dd($user);
    // Truyền dữ liệu user sang view
    return view('pages-account-settings', compact('user'));
}
public function uploadAvatar(Request $request,$id)
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
        $user = User::find($id);
        $user->img = 'assets/images/Avatar/' . $filename;

        $user->save();

        return back()->with('success', 'Avatar updated successfully.');
    }


    return back()->withErrors('Error uploading image.');
}

// Method to generate OTP and send it via email
public function register(Request $request)
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
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'otp' => $otp,
        'status' => 'Waiting', // Set status to 'Waiting' until OTP is verified
    ]);

    // Send OTP to email
    Mail::to($request->email)->send(new OtpMail($otp));

    return redirect()->route('verify.otp.form');
}

// Method to verify OTP
public function verifyOtp(Request $request)
{
    // Kiểm tra OTP
    if ($request->otp == session('otp')) {
        // Tạo tài khoản nếu OTP đúng
        User::create([
            'name' => session('name'),
            'email' => session('email'),
            'password' => session('password'),
            'role_id' => session('role_id'),
            'status' => 'Verified',
        ]);

        // Xóa session sau khi xác thực
        session()->forget(['name', 'email', 'password', 'role_id', 'otp']);

        // Chuyển hướng đến trang success
        return redirect()->route('success')->with('success', 'Account created successfully!');
    }

    // Trả về lỗi nếu OTP sai
    return back()->withErrors(['otp' => 'Invalid OTP']);
}


public function showOtpForm()
{
    return view('auth.verify-otp');
}

public function showSuccess()
{
    return view('plugins-sweetalert');
}



}

