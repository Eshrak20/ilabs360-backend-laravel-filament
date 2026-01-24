<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Get all published blogs
    public function index(Request $request)
    {
        $blogs = Blog::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->with('category:id,name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }

    // Get single blog by slug
    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with('category:id,name')
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }
}
