<?php

namespace App\Http\Controllers;

use App\Models\HomeBuilding;
use Illuminate\Http\Request;

class HomeBuildingController extends Controller
{
    public function index()
    {
        $home_building = HomeBuilding::all();

        return $this->response(true, 'Home building fetched successfully', $home_building, 200);
    }
}
