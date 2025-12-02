<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('module_notifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');

            $table->string('message');
            $table->boolean('read')->default(false);

            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules')->cascadeOnDelete();
            $table->foreign('from_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('to_user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('module_notifications');
    }
};
