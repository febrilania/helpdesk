<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => "admin",
                'email' => "ubingwbc0714@gmail.com",
                'password' => Hash::make('admin@123'),
                'role'=> "admin",
                'email_verified_at' => now(),
            ],
            [
                'name' => "staff",
                'email' => "dailymoeslim7@gmail.com",
                'password' => Hash::make('staff@123'),
                'role'=> "staff",
                'email_verified_at' => now(),
            ],
        ]);
    }
}
