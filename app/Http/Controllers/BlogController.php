<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Get all published blogs with pagination
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $blogs = Blog::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->with([
                'category:id,name',
                'staff' => function($query) {
                    // Load all staff columns
                    $query->with('user'); // include related user
                }
            ])
            ->latest('published_at')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $blogs->items(),
            'meta' => [
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'per_page' => $blogs->perPage(),
                'total' => $blogs->total(),
            ],
        ]);
    }

    // Get single blog by slug
    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->with([
                'category:id,name',
                'staff' => function($query) {
                    // Load **all staff columns** and related user
                    $query->with('user');
                }
            ])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }
}
