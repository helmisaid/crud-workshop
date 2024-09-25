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
        Schema::create('menu_levels', function (Blueprint $table) {
            $table->string('id_level', 30)->primary();
            $table->string('level', 60);
            $table->string('create_by', 30);
            $table->timestamps();
            $table->boolean('delete_mark')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_levels');
    }
};
