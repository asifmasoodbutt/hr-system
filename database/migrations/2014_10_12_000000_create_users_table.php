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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->unsignedBigInteger('gender_id');
            $table->date('date_of_birth');
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('phone_no', 15)->nullable();
            $table->string('father_name', 50);
            $table->unsignedBigInteger('family_detail_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('qualification_id')->nullable();
            $table->unsignedBigInteger('contract_id')->nullable();
            $table->string('bank_name', 50)->nullable();
            $table->string('bank_account_no')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('gender_id')->references('id')->on('genders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('family_detail_id')->references('id')->on('family_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('contract_id')->references('id')->on('contracts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
