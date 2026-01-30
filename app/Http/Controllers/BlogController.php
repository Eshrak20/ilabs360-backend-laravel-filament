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
        $perPage = $request->input('per_page', 10); // default 10 per page

        $blogs = Blog::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->with([
                'category:id,name',
                // Only necessary staff fields + user
                'staff:id,user_id,name,email,image',
                'staff.user:id,name,email'
            ])
            ->latest('published_at')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $blogs->items(), // current page items
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
                'staff:id,user_id,name,email,image',
                'staff.user:id,name,email'
            ])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }
}
