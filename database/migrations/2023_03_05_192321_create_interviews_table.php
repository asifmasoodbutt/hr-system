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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_name');
            $table->email('candidate_email');
            $table->string('candidate_phone');
            $table->string('candidate_cnic')->nullable();
            $table->string('candidate_passport_no')->nullable();
            $table->timestamp('scheduled_time');
            $table->string('resume');
            $table->unsignedBigInteger('hr_id')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled', 'no_show', 'in_progress', 'rescheduled', 'pending', 'declined']);
            $table->string('expected_joining_date');
            $table->string('expected_salary');
            $table->enum('results', ['selected', 'not_selected', 'pending', 'second_round', 'job_offered', 'offer_accepted', 'offer_rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
