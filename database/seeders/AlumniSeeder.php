<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Alumni;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        Alumni::create([
            'email' => 'johndoe@example.com',
            'password' => Hash::make('johndoe!!!'),
            'college_id' => 'C11-01-12345-MAN121',
            'fullname' => 'John Doe',
            'contact' => '09157000000',
            'dob' => '1992-01-13',
            'address' => '1234 Elm Street, City, Country',
            'gender' => 'male',
            'batch' => 2020,
            'graduated_course' => 'Computer Science',
            'company_name' => 'Tech Corp',
            'profile_picture' => null,
            'status' => 'active',
            'email_verified_at' => Carbon::now(),
            'verification_token' => null,
        ]);
    }
}
