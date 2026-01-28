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
        \App\Models\Setting::firstOrCreate([
            'app_name' => 'Portfolio',
            'app_favicon' => null,
            'theme_color' => '#6366f1',
        ]);
    }
}
