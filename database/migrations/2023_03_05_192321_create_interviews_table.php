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
            $table->string('candidate_name', 50);
            $table->email('candidate_email', 70);
            $table->string('candidate_phone', 15);
            $table->string('candidate_cnic', 13)->nullable();
            $table->string('candidate_passport_no', 20)->nullable();
            $table->timestamp('scheduled_time');
            $table->string('resume');
            $table->unsignedBigInteger('hr_id')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled', 'no_show', 'in_progress', 'rescheduled', 'pending', 'declined']);
            $table->decimal('expected_joining_date', );
            $table->decimal('expected_salary', 10, 2);
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
