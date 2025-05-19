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
        Schema::create('alumni_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->nullable()->constrained('alumni')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('category');
            $table->string('position');
            $table->string('company_name');
            $table->string('company_site')->nullable();
            $table->string('location')->nullable();
            $table->string('office_address')->nullable();
            $table->integer('company_established')->nullable();
            $table->string('company_size')->nullable();
            $table->boolean('is_featured')->default(false); 
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('job_description')->nullable();
            $table->string('google_map')->nullable(); 
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('experience_level')->nullable();
            $table->string('qualification')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'draft', 'closed'])->default('pending');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni_jobs', function (Blueprint $table) {
            //
        });
    }
};
