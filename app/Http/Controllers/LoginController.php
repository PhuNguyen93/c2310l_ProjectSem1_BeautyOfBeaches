<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);
    //     // dd(1);
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect()->route('index'); // Chuyển đến trang home
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ])->onlyInput('email');

    // }
    public function authenticate(Request $request)
    {
        // Kiểm tra đầu vào là email hay số điện thoại
        $credentials = $request->validate([
            'email' => ['required', 'string'], // Có thể là email hoặc phone
            'password' => ['required'],
        ]);

        $loginField = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where($loginField, $request->input('email'))->first();
        if (!$user || $user->status == 0) {
            return back()->withErrors([
                'email' => 'Your account is inactive or does not exist.',
            ])->onlyInput('email');
        }
        // Đăng nhập bằng email hoặc số điện thoại
        if (Auth::attempt([$loginField => $request->input('email'), 'password' => $request->input('password')])) {
            $request->session()->regenerate();
            return redirect()->route('index'); // Chuyển đến trang home
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

}
