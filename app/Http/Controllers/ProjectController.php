<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        $projects = $projects->map(function ($p) {
            return [
                'id' => $p->id,

                // Core
                'project_name'     => $p->project_name,
                'slug'             => $p->slug,
                'project_type'     => $p->project_type,
                'project_category' => $p->project_category,
                'status'           => $p->status,

                // Descriptions
                'short_description' => $p->short_description,
                'description'       => $p->description,

                // Tech Stack
                'frontend_tech' => $p->frontend_tech,
                'backend_tech'  => $p->backend_tech,
                'database_tech' => $p->database_tech,
                'tools'         => $p->tools,

                // Client Info
                'client_name'    => $p->client_name,
                'client_company' => $p->client_company,
                'client_review'  => $p->client_review,
                'client_rating'  => $p->client_rating,

                // Media
                'banner'         => $p->banner,
                'thumbnail'      => $p->thumbnail,
                // 'gallery_images' => $p->gallery_images ?? [],
                'gallery_images' => collect($p->gallery_images ?? [])
                    ->map(fn($img) => $this->storageUrl($img))
                    ->values(),

                'project_video'  => $p->project_video,
                'live_url'       => $p->live_url,
                'github_url'     => $p->github_url,

                // Timeline
                'start_date'    => $p->start_date,
                'handover_date' => $p->handover_date,

                // SEO
                'seo_title'       => $p->seo_title,
                'seo_description' => $p->seo_description,

                'created_at' => $p->created_at,
                'updated_at' => $p->updated_at,
            ];
        });

        return $this->response(true, 'Projects fetched successfully', $projects, 200);
    }

    public function getProjectById($id)
    {
        $p = Project::findOrFail($id);

        $project = [
            'id' => $p->id,

            // Core
            'project_name'     => $p->project_name,
            'slug'             => $p->slug,
            'project_type'     => $p->project_type,
            'project_category' => $p->project_category,
            'status'           => $p->status,

            // Descriptions
            'short_description' => $p->short_description,
            'description'       => $p->description,

            // Tech Stack
            'frontend_tech' => $p->frontend_tech,
            'backend_tech'  => $p->backend_tech,
            'database_tech' => $p->database_tech,
            'tools'         => $p->tools,

            // Client Info
            'client_name'    => $p->client_name,
            'client_company' => $p->client_company,
            'client_review'  => $p->client_review,
            'client_rating'  => $p->client_rating,

            // Media
            'banner'         => $p->banner,
            'thumbnail'      => $p->thumbnail,
            // 'gallery_images' => $p->gallery_images ?? [],
            'gallery_images' => collect($p->gallery_images ?? [])
                ->map(fn($img) => $this->storageUrl($img))
                ->values(),

            'project_video'  => $p->project_video,
            'live_url'       => $p->live_url,
            'github_url'     => $p->github_url,

            // Timeline
            'start_date'    => $p->start_date,
            'handover_date' => $p->handover_date,

            // SEO
            'seo_title'       => $p->seo_title,
            'seo_description' => $p->seo_description,

            'created_at' => $p->created_at,
            'updated_at' => $p->updated_at,
        ];

        return $this->response(true, 'Project fetched successfully', $project, 200);
    }
    private function storageUrl($path)
    {
        return $path ? asset('storage/' . $path) : null;
    }
}
