<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Profile::create([
            'foto' => null,
            'name' => 'John Doe',
            'as' => 'Web Developer',
            'bio' => 'Passionate developer with experience in building web applications using Laravel and Vue.js.',
            'experience' => 3,
            'cv_url' => null,
            'email' => 'john.doe@example.com',
            'phone' => '+1234567890',
            'address' => '123 Main St, Anytown, USA',
            'github_url' => null,
            'linkedin_url' => null,
            'twitter_url' => null,
            'instagram_url' => null,
        ]);
    }
}
