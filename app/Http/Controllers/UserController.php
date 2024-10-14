<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Mail\OtpMail;
use App\Models\Feedback;
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

    // Bắt đầu truy vấn từ bảng users
    $query = User::query();

    // Nếu có giá trị search, tìm kiếm theo tên và email
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('phone', 'LIKE', "%{$search}%");
        });
    }

    // Phân trang kết quả
    $users = $query->paginate(10);

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
        // dd(1);
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|unique:users,email',
                // Các trường khác
            ],
            [
                'email.unique' => 'Email này đã được sử dụng để đăng ký tài khoản. Vui lòng sử dụng email khác.',
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        // Gửi OTP nếu kiểm tra thành công
        $otp = rand(1000, 9999);
        session([
            'otp' => $otp,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
        // dd(session()->all());
        // Gửi OTP qua email
        Mail::to($request->email)->send(new OtpMail($otp));

        // Chuyển hướng đến form xác minh OTP
        return redirect()->route('verify.otp.form')->with('success', 'OTP has been sent to your email.');
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        // dd(1);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'country' => 'required|string|max:255',
            'phone' => ['string', 'max:10', 'regex:/^[0-9]+$/', Rule::unique('users')->ignore($id)],
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


        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->birth_date = $request->input('birth_date');
        $user->country = $request->input('country');
        $user->save();
        // dd($user);
        return redirect()->route('users.index');
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

        // Đặt trạng thái người dùng là 0 để xóa mềm (deactivate)
        $user->status = 0;
        $user->save();

        // Điều hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('users.index')->with('success', 'User has been trashed');
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

        // Truyền dữ liệu người dùng vào view
        return view('pages-account', compact('user'));
    }

    public function show($id)
    {
        // dd(1);
        $user = User::findOrFail($id);

        $feedbacks = $user->feedbacks()
        ->with('beach')
        ->whereHas('beach', function ($query) {
            $query->where('status', '!=', 0);
        })
        ->paginate(5)->withQueryString();

    // Lọc blog với điều kiện status != 0
        $blogs = $user->blogs()->where('status', '!=', 0)->paginate(5)->withQueryString();
        return view('pages-account', compact('user', 'feedbacks','blogs'));
    }

    public function filterFeedback(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Lấy giá trị lọc từ request
        $rating = $request->input('rating');

        // Lọc bình luận theo số sao nếu có giá trị rating được chọn
        $query = Feedback::where('user_id', $id)->with('beach');

        if (!empty($rating)) {
            $query->where('rating', $rating);
        }

        // Phân trang các bình luận đã lọc
        $feedbacks = $query->whereHas('beach', function ($query) {
            $query->where('status', '!=', 0);
        })
        ->paginate(5)->withQueryString();;
        $blogs = $user->blogs()->where('status', '!=', 0)->paginate(5)->withQueryString();
        // Trả về view cùng với kết quả
        return view('pages-account', compact('user', 'feedbacks','blogs'));
    }

    public function showProfile($id)
    {

        // Lấy dữ liệu của user với ID nhất định
        $user = User::find($id);
        // dd($user);
        // Truyền dữ liệu user sang view
        return view('pages-account-settings', compact('user'));
    }

    public function uploadAvatar(Request $request, $id)
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

        // Save user data temporarily in session
        session([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before storing it
            'otp' => $otp,
            'status' => 'Waiting', // Status until OTP is verified
        ]);

        // Send OTP to email
        Mail::to($request->email)->send(new OtpMail($otp));

        // Redirect to OTP verification page
        return redirect()->route('verify.otp.form');
    }


    // Method to verify OTP
    public function verifyOtp(Request $request)
    {
        // Kiểm tra OTP

        // dd(3);
        if ($request->otp == session('otp')) {
            // Tạo tài khoản nếu OTP đúng
            User::create([
                'name' => session('name'),
                'email' => session('email'),
                'password' => session('password'),
                'role_id' => session('role_id'),
                'status' => '1',
            ]);

            // Xóa session sau khi xác thực
            session()->forget(['name', 'email', 'password', 'role_id', 'otp']);

            // Thông báo thành công OTP
            return redirect()->route('users.index')->with('success', 'Operation successful!');
        }

        // Trả về lỗi nếu OTP sai
        return back()->withErrors(['otp' => 'Invalid OTP']);
    }


    public function showOtpForm()
    {
        // dd(2);
        return view('auth.verify-otp');
    }



    // Phương thức resendOtp để gửi lại mã OTP
    public function resendOtp(Request $request)
    {
        // dd(1);
        // Lấy email của người dùng từ session hoặc một nguồn khác
        $email = session('email');

        // Kiểm tra nếu email tồn tại
        if (!$email) {
            return redirect()->back()->withErrors('Email not found in session.');
        }

        // Tìm người dùng theo email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->withErrors('User not found.');
        }

        // Tạo mã OTP mới
        $otp = rand(1000, 9999);

        // Cập nhật mã OTP cho người dùng
        $user->otp = $otp;
        $user->save();

        // Gửi lại OTP qua email
        Mail::to($user->email)->send(new OtpMail($otp));

        // Trả về thông báo thành công
        return redirect()->back()->with('success', 'OTP has been resent to your email.');
    }


    public function bin(Request $request)
    {
        if (Auth::guest() || Auth::user()->role_id != 2) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }

        $search = $request->input('search');

        $users = User::where('status', 0)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.bin', compact('users'));
    }
    public function destroyBin($id)
    {
        // Tìm người dùng theo ID
        // dd(1);
        $user = User::findOrFail($id);

        // Kiểm tra nếu vai trò của người dùng là admin
        if ($user->role_id == 2) { // 2 là role_id của admin
            // Điều hướng về trang danh sách người dùng với thông báo lỗi
            return redirect()->route('users.index')->with('error', 'Admin account cannot be deleted.');
        }

        // Xóa người dùng nếu không phải admin
        $user->delete();

        // Điều hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('user.bin')->with('success', 'Account deleted successfully.');
    }
    public function restore(User $user)
    {
        $user->status = 1;
        $user->save();

        return redirect()->route('user.bin')->with('success', 'Account has been restored.');
    }
}
