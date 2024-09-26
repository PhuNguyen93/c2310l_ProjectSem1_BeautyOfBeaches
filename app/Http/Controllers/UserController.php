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
        return view('users.edit', compact('user'));
    }

   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
        'birth_date' => 'nullable|date',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'] ?? $user->phone;
        $user->country = $validatedData['country'] ?? $user->country;
        $user->birth_date = $validatedData['birth_date'] ?? $user->birth_date;

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('profile_images', 'public');
            $user->img = $imagePath;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'There was a problem updating the user.']);
    }
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

public function account()
{
    // Lấy người dùng hiện tại
    $user = Auth::user();

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

    // Truyền dữ liệu user sang view
    return view('profile', compact('user'));
}


}

