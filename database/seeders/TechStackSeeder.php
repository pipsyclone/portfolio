<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TechStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Laravel',
            ],
            [
                'name' => 'ReactJS',
            ],
            [
                'name' => 'NextJS',
            ],
            [
                'name' => 'HTML5',
            ],
            [
                'name' => 'CSS',
            ],
            [
                'name' => 'JavaScript',
            ],
            [
                'name' => 'MySQL',
            ],
            [
                'name' => 'PostgreSQL',
            ],
        ];

        foreach ($data as $techstack) {
            \App\Models\TechStacks::firstOrCreate($techstack);
        }
    }
}
