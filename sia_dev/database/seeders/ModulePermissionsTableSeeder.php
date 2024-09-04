<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Role; // Import the Role model
use App\Models\Permission; // Import the Permission model

class ModulePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example modules
        $modules = ['Students', 'Teachers', 'Departments', 'Classes', 'Subjects', 'Attendances'];

        // Retrieve existing roles and permissions
        $adminRole = Role::where('name', 'Admin')->first();
        $createPermission = Permission::where('name', 'Create')->first();

        if ($adminRole && $createPermission) {
            foreach ($modules as $module) {
                DB::table('module_permissions')->insert([
                    'id_module_permissions' => (string) Str::uuid(),
                    'module_name' => $module,
                    'role_id' => $adminRole->id_roles, // Replace with actual role UUID
                    'permission_id' => $createPermission->id_permissions, // Replace with actual permission UUID
                    'expires_at' => '2025-12-31',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } else {
            echo "Roles or permissions not found. Please check your database.\n";
        }
    }
}
