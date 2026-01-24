<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $home_banners = Service::all();
        return $this->response(true, 'Home Banners fetched successfully', $home_banners, 201);
    }
}
