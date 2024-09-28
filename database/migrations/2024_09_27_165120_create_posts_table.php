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
        Schema::create('posts', function (Blueprint $table) {
            $table->string('post_id', 30)->primary();
            $table->string('sender', 30);
            $table->text('message_text');
            $table->string('post_image', 200)->nullable();
            $table->string('create_by', 30);
            $table->timestamp('create_date')->useCurrent();
            $table->char('delete_mark', 1)->default('0');
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
