<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Setting::firstOrCreate(
            ['id' => 1],
            [
            'app_name' => 'Dashboard Starter',
            'app_name_short' => 'DS',
            'app_color' => '#6366f1',
            'app_logo' => null,
            'app_favicon' => null,
            'app_stempel' => null,
            'app_background_login_image' => null,
            'youtube_link' => null,
            'instagram_link' => null,
            'tiktok_link' => null,
            'facebook_link' => null,
            'x_twitter_link' => null,
        ]);
    }
}
