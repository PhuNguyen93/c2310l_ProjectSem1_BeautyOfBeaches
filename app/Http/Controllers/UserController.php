<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hàm để hiển thị danh sách người dùng với phân trang
    public function index(Request $request)
    {
        $users = User::paginate(10); // Lấy 10 bản ghi mỗi trang
        return view('apps-users-list', compact('users'));
    }

    // Hàm để hiển thị form tạo người dùng mới (nếu cần)
    public function create()
    {
        // Trả về view tạo người dùng
        return view('users.create');
    }

    // Hàm để lưu người dùng mới (nếu cần)
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer',
        ]);

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Người dùng đã được tạo thành công.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Các hàm khác như update, destroy nếu cần
}
