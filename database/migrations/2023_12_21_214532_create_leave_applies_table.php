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
        Schema::create('leave_applies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('leave_type_id');
            $table->enum('status', ['pending', 'approved', 'not-approved'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('from_date');
            $table->date('to_date');
            $table->string('description');
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_applies');
    }
};
