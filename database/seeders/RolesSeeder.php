<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\Permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = [
            'ViewAny' => 'Access',
            'View'    => 'View',
            'Create'  => 'Create',
            'Update'  => 'Update',
            'Delete'  => 'Delete',
            'Restore' => 'Restore',
            'ForceDelete' => 'Force Delete',
        ];

        $resources = [
            // Standalone
            'Setting' => [
                'ViewAny',
            ],
            'DatabaseBackup' => [
                'ViewAny',
                'Create',
                'Delete',
            ],
            'ActivityLogs' => [
                'ViewAny',
                'View',
                'Delete'
            ],
            'Contacts' => [
                'ViewAny',
                'View',
                'Delete'
            ],

            // CRUD
            'User',
            'Roles',
            'Projects',
            'TechStacks',
            'Specializations',
        ];

        $allPermissions = collect();

        foreach ($resources as $key => $value) {
            if (is_numeric($key)) {
                $resource = $value;
                $resourceActions = array_keys($actions);
            } else {
                $resource = $key;
                $resourceActions = $value;
            }
            
            // Buat Policy otomatis jika belum ada
            $policyName = "{$resource}Policy";
            if (!file_exists(app_path("Policies/{$policyName}.php"))) {
                \Illuminate\Support\Facades\Artisan::call('make:policy', [
                    'name' => $policyName,
                ]);
            }

            foreach ($resourceActions as $action) {
                $permissionSlug = str($action . '_' . $resource)->snake()->lower()->value();
                
                // Menyusun deskripsi, misal: "Melihat daftar" + " user"
                $resourceName = strtolower(preg_replace('/(?<!^)[A-Z]/', ' $0', $resource));
                $description = ($actions[$action] ?? $action);
                
                $permission = Permissions::firstOrCreate(
                    ['slug' => $permissionSlug],
                    [
                        'name' => "{$action}:{$resource}",
                        'slug' => $permissionSlug,
                        'description' => $description,
                    ]
                );

                $allPermissions->push($permission);
            }
        }

        // Definisi role dan custom permission masing-masing
        $roles = [
            [
                'name' => 'Superadmin',
                'slug' => 'superadmin',
                'description' => 'Superadministrator dengan akses penuh',
                // Superadmin mendapatkan semua permission
                'permissions' => $allPermissions->pluck('id')->toArray(),
            ],
        ];

        foreach ($roles as $roleData) {
            $role = Roles::firstOrCreate(
                ['slug' => $roleData['slug']],
                [
                    'name' => $roleData['name'],
                    'description' => $roleData['description'],
                ]
            );

            // Sinkronisasi permission menggunakan sync()
            // ini akan memastikan permission yang terhubung sesuai dengan yang didefinisikan (menghapus yang lama jika tidak ada di array)
            if (isset($roleData['permissions'])) {
                $role->permissions()->sync($roleData['permissions']);
            }
        }
    }
}
