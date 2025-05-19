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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('college_id')->unique();
            $table->string('fullname');
            $table->string('contact');
            $table->date('dob')->nullable();
            $table->text('address')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->enum('civil_status', ['single', 'married', 'widowed', 'divorced', 'separated', 'annulled'])->default('single');
            $table->year('batch');
            $table->string('graduated_course');
            $table->enum('employability_status', ['employed','self_employed', 'unemployed'])->default('unemployed');
            $table->string('company_name')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('github_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->enum('status', ['active','inactive', 'banned'])->default('inactive');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
