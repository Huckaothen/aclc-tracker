<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use App\Models\Alumni;
use App\Models\User;
use App\Models\AlumniJob;

class AlumniJobSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch an existing alumni
        $alumni = Alumni::inRandomOrder()->first();
        $admin = User::where('role', 'admin')->inRandomOrder()->first();

        // Log an error if alumni or admin is missing
        if (!$alumni || !$admin) {
            Log::error('Alumni or Admin not found. Please run AlumniSeeder and UserSeeder first.');
            return;
        }

        // Job added by an alumni
        AlumniJob::create([
            'alumni_id' => $alumni->id,
            'user_id' => null,
            'category' => 'IT / Computers',
            'company_name' => 'Tech Corp',
            'position' => 'Software Engineer',
            'start_date' => now()->subYears(2)->format('Y-m-d'),
            'end_date' => null,
            'job_description' => 'Developing and maintaining web applications.',
            'salary' => rand(60000, 80000), // Random salary for variation
            'status' => 'pending',
        ]);

        // Job posted by an admin
        AlumniJob::create([
            'alumni_id' => null,
            'user_id' => $admin->id,
            'category' => 'Accounting / Finance',
            'company_name' => 'Global Solutions',
            'position' => 'Project Manager',
            'start_date' => now()->subYear()->format('Y-m-d'),
            'end_date' => null,
            'job_description' => 'Managing software development projects.',
            'salary' => rand(90000, 100000),
            'status' => 'approved',
        ]);

        // Log success
        Log::info('AlumniJobSeeder executed successfully.');
    }
}
