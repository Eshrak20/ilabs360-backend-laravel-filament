<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::all();

        return $this->response(true, 'Staff information fetched successfully', $staffs, 200);
    }
}
