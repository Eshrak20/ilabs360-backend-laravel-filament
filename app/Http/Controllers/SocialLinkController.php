<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $social_links = SocialLink::all();
        return $this->response(true, 'Social Links fetched successfully', $social_links, 201);
    }
}
