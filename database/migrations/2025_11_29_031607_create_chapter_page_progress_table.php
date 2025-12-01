<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapter_page_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('chapter_id')->constrained()->cascadeOnDelete();
            $table->foreignId('page_id')->constrained('chapter_pages')->cascadeOnDelete();
            $table->enum('status', ['pending','done'])->default('pending');
            $table->text('answer')->nullable();
            $table->tinyInteger('score')->nullable()->default(0);
            $table->timestamps();

            $table->unique(['user_id','chapter_id','page_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapter_page_progress');
    }
};
