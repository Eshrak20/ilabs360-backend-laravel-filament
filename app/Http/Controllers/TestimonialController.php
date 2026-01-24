<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::all();

        return $this->response(true, 'Testimonial information fetched successfully', $testimonial, 200);
    }
}
