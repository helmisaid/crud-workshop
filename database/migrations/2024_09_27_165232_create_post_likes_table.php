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
        Schema::create('post_likes', function (Blueprint $table) {
            $table->string('like_id', 30)->primary();
            $table->string('post_id', 30);
            $table->unsignedBigInteger('user_id');
            $table->string('create_by', 30);
            $table->timestamp('create_date')->useCurrent();
            $table->char('delete_mark', 1)->default('0');
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();

            // Foreign key constraint
            $table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_likes');
    }
};
