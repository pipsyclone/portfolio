<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Admin User
        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Superadmin',
                'email' => 'superadmin@example.com',
                'phone' => '1234567890',
                'password' => Hash::make('123'),
            ]
        );

        // Attach role superadmin
        $superadminRole = Roles::where('slug', 'superadmin')->first();
        if ($superadminRole) {
            $superadmin->roles()->syncWithoutDetaching([$superadminRole->id]);
        }
    }
}
