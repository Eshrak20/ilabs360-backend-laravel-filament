<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('staff', function (Blueprint $table) {

            // Relation with users table
            $table->foreignId('user_id')
                ->nullable()
                ->after('id')
                ->constrained('users')
                ->nullOnDelete();

            // Personal info
            $table->unsignedTinyInteger('age')
                ->nullable()
                ->after('name');

            $table->text('bio')
                ->nullable()
                ->after('description');
            $table->string('location')
                ->nullable()
                ->after('bio');

            // Company-related info
            $table->unsignedTinyInteger('years_in_company')
                ->nullable()
                ->after('designation');

            $table->string('department')
                ->nullable()
                ->after('designation');

            $table->string('employment_type')
                ->nullable()
                ->comment('Full-time, Part-time, Contract')
                ->after('department');

            // Skills & expertise
            $table->json('skills')
                ->nullable()
                ->after('employment_type');

            // Professional info
            $table->date('joining_date')
                ->nullable()
                ->after('years_in_company');

            $table->string('github_url')
                ->nullable()
                ->after('linkedin_url');

            $table->string('portfolio_url')
                ->nullable()
                ->after('github_url');
        });
    }

    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            $table->dropColumn([
                'user_id',
                'age',
                'bio',
                'years_in_company',
                'department',
                'employment_type',
                'skills',
                'joining_date',
                'github_url',
                'portfolio_url',
            ]);
        });
    }
};
