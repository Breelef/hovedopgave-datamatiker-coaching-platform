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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('activity_type', 100)->nullable()->index();
            $table->string('exercise_type', 100)->index();
            $table->string('name', 255);
            $table->string('slug', 255)->index();
            $table->json('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('video_url', 255)->nullable();
            $table->unsignedInteger('age_group_id_from')->nullable();
            $table->unsignedInteger('age_group_id_to')->nullable();
            $table->unsignedTinyInteger('age_from')->nullable();
            $table->unsignedTinyInteger('age_to')->nullable();
            $table->unsignedTinyInteger('players_from')->nullable();
            $table->unsignedTinyInteger('players_to')->nullable();
            $table->unsignedTinyInteger('duration_from')->nullable();
            $table->unsignedTinyInteger('duration_to')->nullable();
            $table->unsignedSmallInteger('order_column')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
