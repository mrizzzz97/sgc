<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('chapter_completions', function (Blueprint $table) {
            $table->timestamp('completed_at')->nullable()->after('chapter_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapter_completions', function (Blueprint $table) {
            //
        });
    }
};
