<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'id_roles' => (string) Str::uuid(),
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        Role::create([
            'id_roles' => (string) Str::uuid(),
            'name' => 'Create',
            'guard_name' => 'web',
        ]);

        Role::create([
            'id_roles' => (string) Str::uuid(),
            'name' => 'Read',
            'guard_name' => 'web',
        ]);

        Role::create([
            'id_roles' => (string) Str::uuid(),
            'name' => 'Update',
            'guard_name' => 'web',
        ]);

        Role::create([
            'id_roles' => (string) Str::uuid(),
            'name' => 'Delete',
            'guard_name' => 'web',
        ]);

        Role::create([
            'id_roles' => (string) Str::uuid(),
            'name' => 'Extract',
            'guard_name' => 'web',
        ]);
    }
}
