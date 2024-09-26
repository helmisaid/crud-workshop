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
        Schema::create('message', function (Blueprint $table) {
            $table->string('message_id', 30)->primary();
            $table->string('sender', 30);
            $table->string('subject', 30);
            $table->text('message_text');
            $table->string('message_status', 30);
            $table->string('no_mk', 30);
            $table->foreign('no_mk')->references('no_mk')->on('message_category');
            $table->string('create_by', 30);
            $table->timestamps();
            $table->string('delete_mark', 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
