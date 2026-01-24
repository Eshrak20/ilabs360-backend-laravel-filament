<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Role system
            $table->string('role')
                ->default('user')
                ->after('password');

            // Is user active or blocked
            $table->boolean('is_active')
                ->default(true)
                ->after('role');

            // Can access website frontend
            $table->boolean('web_view')
                ->default(true)
                ->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'is_active',
                'web_view',
            ]);
        });
    }
};
