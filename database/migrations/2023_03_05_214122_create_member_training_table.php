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
        Schema::create('member_training', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('training_id');
            $table->string('role', 20);
            $table->string('score')->nullable();
            $table->enum('result', ['passed', 'satisfactory', 'failed', 'incomplete'])->nullable();
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('training_id')->references('id')->on('trainings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_training');
    }
};
