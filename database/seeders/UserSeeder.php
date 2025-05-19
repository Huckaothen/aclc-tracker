<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'aclcadmin@gmail.com',
            'password' => Hash::make('aclcadmin!'),
            'status' => 'active',
            'role' => 'admin',
        ]);
    }
}
