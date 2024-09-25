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
        Schema::table('multiple_tables', function (Blueprint $table) {
            Schema::table('bukus', function (Blueprint $table) {
                $table->softDeletes(); // Menambahkan kolom deleted_at
            });

            Schema::table('categories', function (Blueprint $table) {
                $table->softDeletes(); // Menambahkan kolom deleted_at
            });

            Schema::table('users', function (Blueprint $table) {
                $table->softDeletes(); // Menambahkan kolom deleted_at
            });

            Schema::table('menu_levels', function (Blueprint $table) {
                $table->softDeletes(); // Menambahkan kolom deleted_at
            });

            Schema::table('menus', function (Blueprint $table) {
                $table->softDeletes(); // Menambahkan kolom deleted_at
            });

            Schema::table('setting_menu_user', function (Blueprint $table) {
                $table->softDeletes(); // Menambahkan kolom deleted_at
            });

            Schema::table('jenis_user', function (Blueprint $table) {
                $table->softDeletes(); // Menambahkan kolom deleted_at
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('multiple_tables', function (Blueprint $table) {
            Schema::table('bukus', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });

            Schema::table('categories', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });

            Schema::table('users', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });

            Schema::table('menu_levels', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });

            Schema::table('menus', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });

            Schema::table('setting_menu_user', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });

            Schema::table('jenis_user', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        });
    }
};
