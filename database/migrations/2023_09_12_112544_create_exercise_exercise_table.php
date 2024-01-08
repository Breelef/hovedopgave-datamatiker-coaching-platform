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
        Schema::create('exercise_exercise', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_exercise_id')->index();
            $table->foreign('parent_exercise_id')->references('id')->on('exercises')->onDelete('cascade');

            $table->unsignedBigInteger('child_exercise_id')->index();
            $table->foreign('child_exercise_id')->references('id')->on('exercises')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_exercise');
    }
};
