<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {

            // remove columns
            $table->dropColumn(['button_text', 'button_link']);

            // rename subtitle to description
            $table->renameColumn('subtitle', 'description');
        });

        // change column type to TEXT
        Schema::table('services', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {

            // restore removed columns
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();

            // rename back
            $table->renameColumn('description', 'subtitle');
        });

        // revert type back to string
        Schema::table('services', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->change();
        });
    }
};
