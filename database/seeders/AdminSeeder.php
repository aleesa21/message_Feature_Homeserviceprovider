<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'homeadmin@gmail.com'], // Change this to your actual admin email
            [
                'name' => 'Alisha',
                'role' => 'Admin', // Assign the role
                'phone' => '1234567890',
                'address' => 'Brt-5',
                'password' => Hash::make('admin@123'), // Change this to a secure password
            ]
        );
    }
}
