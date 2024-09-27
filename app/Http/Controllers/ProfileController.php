<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($id), // Kiểm tra name duy nhất, bỏ qua user hiện tại
            ],
            'country' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:10',
                'regex:/^[0-9]+$/', // Chỉ cho phép số
                Rule::unique('users')->ignore($id), // Kiểm tra phone duy nhất, bỏ qua user hiện tại
            ],
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


}
