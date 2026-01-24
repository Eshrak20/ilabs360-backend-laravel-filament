<?php

namespace App\Http\Controllers;

use App\Models\GalleryVideo;
use Illuminate\Http\Request;

class GalleryVideoController extends Controller
{
    public function index()
    {
        $gallery_videos = GalleryVideo::all();

        return $this->response(true, 'Gallery Images fetched successfully', $gallery_videos, 200);
    }
}
