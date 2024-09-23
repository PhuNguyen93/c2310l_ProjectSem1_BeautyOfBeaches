<?php

namespace App\Http\Controllers;

use App\Models\VehicleBorrowing;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Lấy tất cả các lần mượn xe cùng với thông tin về driver và vehicle
        if (Auth::user()->role_id != 2) {
            return redirect()->route('index')->with('error', 'You do not have the required permissions.');
        }
        // Truyền dữ liệu vào view
        return view('dashboard');
    }
}
