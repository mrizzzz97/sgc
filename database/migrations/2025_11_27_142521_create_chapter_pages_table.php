<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapter_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained()->onDelete('cascade');

            $table->integer('page_number');
            $table->enum('type', ['video', 'question']);

            // VIDEO
            $table->string('video_url')->nullable();

            // QUESTION
            $table->text('question_text')->nullable();
            $table->text('options')->nullable();
            $table->string('correct_answer')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapter_pages');
    }
};
