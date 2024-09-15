<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1, 
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), 
            'email_verified_at' => now(),
        ]);
    }
}
