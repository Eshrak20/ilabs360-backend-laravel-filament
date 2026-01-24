<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Core
            $table->string('project_name');
            $table->string('slug')->unique();
            $table->enum('project_type', ['web', 'mobile', 'desktop', 'api']);
            $table->enum('project_category', ['frontend', 'backend', 'fullstack']);
            $table->enum('status', ['ongoing', 'completed', 'paused'])->default('ongoing');

            // Descriptions
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Tech Stack
            $table->string('frontend_tech')->nullable();
            $table->string('backend_tech')->nullable();
            $table->string('database_tech')->nullable();
            $table->string('tools')->nullable();

            // Client Info
            $table->string('client_name')->nullable();
            $table->string('client_company')->nullable();
            $table->text('client_review')->nullable();
            $table->tinyInteger('client_rating')->nullable();

            // Media
            $table->string('banner')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('project_video')->nullable();
            $table->string('live_url')->nullable();
            $table->string('github_url')->nullable();

            // Timeline
            $table->date('start_date')->nullable();
            $table->date('handover_date')->nullable();

            // SEO
            $table->string('seo_title')->nullable();    
            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
