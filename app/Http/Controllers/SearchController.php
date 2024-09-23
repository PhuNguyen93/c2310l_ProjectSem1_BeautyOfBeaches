<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beach;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');

        // Tìm kiếm theo tên bãi biển
        $beaches = Beach::where('name', 'LIKE', '%' . $query . '%')->get();

        // Trả về view với dữ liệu bãi biển
        return view('search_results', compact('beaches'));
    }
}
