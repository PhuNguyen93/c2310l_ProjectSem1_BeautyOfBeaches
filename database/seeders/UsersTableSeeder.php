<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Đảm bảo bạn đã import model User

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Tạo tài khoản admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'), // Mã hóa mật khẩu
            'role_id' => 1, // ID của vai trò admin
        ]);

        // Tạo tài khoản user
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('123'), // Mã hóa mật khẩu
            'role_id' => 2, // ID của vai trò user
        ]);
    }
}
