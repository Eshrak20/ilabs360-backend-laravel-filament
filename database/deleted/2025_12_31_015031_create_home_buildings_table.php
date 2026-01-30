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
        Schema::create('home_buildings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title');
            $table->string('total_area_built')->nullable();
            $table->string('total_commercial_spaces')->nullable();
            $table->string('total_residential_projects')->nullable();
            $table->string('year_of_excellence')->nullable();
            $table->string('image');
            $table->string('videoID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_buildings');
    }
};
