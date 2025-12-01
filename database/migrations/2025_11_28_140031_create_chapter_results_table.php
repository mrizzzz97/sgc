<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chapter_results', function (Blueprint $table) {
            $table->id();

            // relasi ke users & chapters
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('chapter_id')->constrained()->cascadeOnDelete();

            // nilai per chapter
            $table->integer('score')->default(0);      // nilai dalam persen
            $table->integer('correct')->default(0);    // jumlah benar
            $table->integer('total')->default(0);      // total soal
            $table->boolean('passed')->default(false); // apakah lulus (>=75)

            $table->timestamps();

            // 1 user hanya bisa punya 1 hasil untuk 1 chapter
            $table->unique(['user_id', 'chapter_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chapter_results');
    }
};
