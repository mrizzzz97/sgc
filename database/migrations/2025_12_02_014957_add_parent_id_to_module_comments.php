<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('module_comments', function (Blueprint $table) {

            // Tambah kolom parent_id untuk reply
            $table->unsignedBigInteger('parent_id')
                ->nullable()
                ->after('user_id');

            // Relasi parent -> id komentar
            $table->foreign('parent_id')
                ->references('id')
                ->on('module_comments')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('module_comments', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['parent_id']);

            // Drop kolom
            $table->dropColumn('parent_id');
        });
    }

};
