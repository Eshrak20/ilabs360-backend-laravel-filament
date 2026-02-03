<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::with('user')
            ->whereHas('user', function ($query) {
                $query->where('web_view', true);
            })
            ->orderBy('position', 'asc') // ✅ LOW position first (1,2,3...)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Staff information fetched successfully',
            'data'    => $staffs,
            'meta'    => [
                'total_staffs' => $staffs->count(),
            ],
        ], 200);
    }
}
