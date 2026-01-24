<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->enum('project_type', ['residential', 'commercial', 'land']);
            $table->enum('status', ['ongoing', 'completed', 'upcoming'])->default('ongoing');
            $table->boolean('featured')->default(false);
            $table->decimal('starting_price', 12, 2)->nullable();
            $table->date('handover_date')->nullable();
            $table->longText('google_map')->nullable();
            $table->string('banner')->nullable();
            $table->string('image')->nullable();
            $table->string('videoID')->nullable();
            $table->string('land_area')->nullable();
            $table->string('face_of_land')->nullable();
            $table->string('speciality_of_land')->nullable();
            $table->string('front_road_width')->nullable();
            $table->string('size_of_apartments')->nullable();
            $table->string('rajuk_approval_no')->nullable();
            $table->string('no_of_floors')->nullable();
            $table->string('no_of_apartments')->nullable();
            $table->string('no_of_basements')->nullable();
            $table->string('no_of_parking')->nullable();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
