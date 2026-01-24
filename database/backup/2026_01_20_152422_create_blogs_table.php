<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            // Titles
            $table->string('title');
            $table->string('title_bng')->nullable();

            // Slug
            $table->string('slug')->unique();

            // Content (English)
            $table->longText('content')->nullable();
            $table->longText('summary')->nullable();

            // Content (Bangla)
            $table->longText('content_bng')->nullable();
            $table->longText('summary_bng')->nullable();

            // Featured Image
            $table->string('featured_image')->nullable();

            // Category
            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Status
            $table->enum('status', ['draft', 'published'])->default('draft');

            // Publish Time
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
