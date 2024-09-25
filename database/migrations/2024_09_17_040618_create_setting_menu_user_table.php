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
        Schema::create('setting_menu_user', function (Blueprint $table) {
            $table->string('no_setting', 30);
            $table->unsignedBigInteger('id_jenis_user');
            $table->foreign('id_jenis_user')->references('id_jenis_user')->on('jenis_user')->onDelete('cascade');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('menu_id')->on('menus')->onDelete('cascade');
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
        Schema::dropIfExists('setting_menu_user');
    }
};
