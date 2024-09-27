<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    // Validate dữ liệu nhập vào
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:0',
        'role_id' => 'required|integer',
        'status' => 'required|string|in:Verified,Waiting,Rejected',
    ]);

     // Kiểm tra xem email đã tồn tại chưa
     if (User::where('email', $request->email)->exists()) {
        return redirect()->back()->withErrors(['email' => 'Email đã tồn tại.'])->withInput();
    }

    // Thêm người dùng vào cơ sở dữ liệu
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Mã hóa mật khẩu
        'role_id' => $request->role_id,
        'status' => $request->status,
    ]);

    // Chuyển hướng lại trang danh sách với thông báo thành công
    return redirect()->route('users.index')->with('success', 'User added successfully!');
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
        'name' => 'required|string|max:255',
        // 'country' => 'required|string|max:255',
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


}

