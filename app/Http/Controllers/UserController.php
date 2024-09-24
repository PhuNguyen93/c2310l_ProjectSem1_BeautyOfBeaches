<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Hàm để hiển thị danh sách người dùng với phân trang
    public function index(Request $request)
{
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
    // Lấy người dùng theo ID
    $user = User::findOrFail($id);

    // Kiểm tra và validate dữ liệu
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
        'role_id' => 'required|integer|exists:roles,id',
        'status' => 'required|in:Verified,Waiting,Rejected',
    ]);

    try {
        // Cập nhật dữ liệu người dùng
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Nếu người dùng muốn cập nhật mật khẩu
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Cập nhật role và status
        $user->role_id = $validatedData['role_id'];
        $user->status = $validatedData['status'];

        // Lưu thay đổi
        $user->save();

        // Điều hướng về trang danh sách người dùng
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        // Nếu có lỗi xảy ra, chuyển hướng về trang trước và hiển thị lỗi
        return redirect()->back()->withErrors(['error' => 'There was a problem updating the user.']);
    }
}

     // Hàm để xóa người dùng
     public function destroy($id)
     {
         // Tìm người dùng theo ID
         $user = User::findOrFail($id);

         // Xóa người dùng
         $user->delete();

         // Điều hướng về trang danh sách người dùng với thông báo thành công
         return redirect()->route('users.index')->with('success', 'User deleted successfully.');
     }
}
