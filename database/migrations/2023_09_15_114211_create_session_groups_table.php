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
        Schema::create('session_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_plan_id');
            $table->date('starts_at');
            $table->date('ends_at')->nullable();
            $table->string('name');
            $table->timestamps();

            $table->foreign('training_plan_id')->references('id')->on('training_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_groups');
    }
};
