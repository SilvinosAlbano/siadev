<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        Permission::create([
            'id_permissions' => (string) Str::uuid(),
            'name' => 'manage_users',
            'guard_name' => 'web',
        ]);

        Permission::create([
            'id_permissions' => (string) Str::uuid(),
            'name' => 'manage_roles',
            'guard_name' => 'web',
        ]);

        Permission::create([
            'id_permissions' => (string) Str::uuid(),
            'name' => 'manage_permissions',
            'guard_name' => 'web',
        ]);
    }
}
