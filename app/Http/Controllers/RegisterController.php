<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string|confirmed',
            // 'role_id' => 'required|integer', // Chắc chắn rằng role_id là bắt buộc
        ]);

        //  dd( $request->role_id);
        // Lưu user vào database
            // 'password' => 'required|string|min:8|confirmed',

        // Lưu user vào database'
        // dd($request);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id, // Sử dụng giá trị từ form
        ]);
        // Redirect về trang đăng nhập
        return redirect()->route('login')->with('success', 'Registration successful.');
    }
}
