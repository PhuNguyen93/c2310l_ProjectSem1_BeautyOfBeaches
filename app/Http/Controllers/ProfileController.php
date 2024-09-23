<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        return view('profile', ['user' => $user]);
    }
}
