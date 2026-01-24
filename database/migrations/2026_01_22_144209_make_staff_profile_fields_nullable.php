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
        //
        Schema::table('staff', function (Blueprint $table) {
            $table->string('designation')->nullable()->change();
            $table->string('department')->nullable()->change();
            $table->unsignedTinyInteger('age')->nullable()->change();
            $table->string('employment_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
