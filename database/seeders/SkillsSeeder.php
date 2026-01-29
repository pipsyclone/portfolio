<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Front-End Development',
                'icon' => 'fa-brands fa-react',
            ],
            [
                'name' => 'Back-End Development',
                'icon' => 'fa-solid fa-laptop-code',
            ],
            [
                'name' => 'Full-Stack Development',
                'icon' => 'fa-solid fa-code',
            ],
            [
                'name' => 'Database Management',
                'icon' => 'fa-solid fa-database',
            ],
            [
                'name' => 'Developer Operations (DevOps)',
                'icon' => 'fa-solid fa-gears',
            ]
        ];

        foreach ($data as $skill) {
            \App\Models\Skills::firstOrCreate($skill);
        }
    }
}
