<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('chapters', function (Blueprint $table) {
            if (Schema::hasColumn('chapters', 'content')) {
                $table->dropColumn('content');
            }
            if (Schema::hasColumn('chapters', 'video_url')) {
                $table->dropColumn('video_url');
            }
        });
    }

    public function down()
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->text('content')->nullable();
            $table->string('video_url')->nullable();
        });
    }
};
