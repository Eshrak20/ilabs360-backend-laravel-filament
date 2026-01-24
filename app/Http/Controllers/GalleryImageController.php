<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    public function index()
    {
        $gallery_images = GalleryImage::all();

        return $this->response(true, 'Gallery Images fetched successfully', $gallery_images, 200);
    }
}
