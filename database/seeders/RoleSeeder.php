<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'), // Password: admin
            'role' => 'admin', // Role set to 'admin'
        ]);

        // Create a writer user
        User::create([
            'name' => 'Writer User',
            'email' => 'writer@example.com',
            'password' => Hash::make('writer'), // Password: writer
            'role' => 'writer', // Role set to 'writer'
        ]);
    }
}
