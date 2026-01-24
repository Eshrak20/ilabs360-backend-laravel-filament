<?php

namespace App\Http\Controllers;

use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
{
    public function index()
    {
        $home_sections = HomeSection::with('metrics')->get();
        return $this->response(true, 'Home Section fetched Successfully',$home_sections, 201);
    }
}
