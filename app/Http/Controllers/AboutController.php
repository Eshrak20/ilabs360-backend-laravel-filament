<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::all();

        return $this->response(true, 'About information fetched successful', $about, 200);
    }
}
