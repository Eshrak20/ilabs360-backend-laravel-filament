<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            // Drop old foreign key
            $table->dropForeign(['user_id']);

            // Add new foreign key with cascade on delete
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            // Drop cascade foreign key
            $table->dropForeign(['user_id']);

            // Revert to nullable without cascade
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }
};
