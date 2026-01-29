<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exists = \App\Models\User::where('email', 'admin@example.com')->exists();

        if (!$exists) {
            \App\Models\User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('123'),
            ]);
        }
    }
}
