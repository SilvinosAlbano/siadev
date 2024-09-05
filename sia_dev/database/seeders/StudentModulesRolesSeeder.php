<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentModulesRolesSeeder extends Seeder
{
    public function run()
    {
        $roles = DB::table('roles')->pluck('id_roles')->toArray();
        $users = DB::table('users')->pluck('user_id')->toArray();
        $modules = DB::table('modules')->pluck('id_module')->toArray();

        $maxModulesPerUser = 3; // Maximum number of modules a user can have
        $studentModulesRoles = [];

        foreach ($users as $user) {
            // Get a random number of modules for this user
            $userModules = array_rand(array_flip($modules), rand(1, $maxModulesPerUser));

            // Ensure userModules is an array
            if (!is_array($userModules)) {
                $userModules = [$userModules];
            }

            foreach ($userModules as $module) {
                // Assign each module a random role
                $role = $roles[array_rand($roles)];

                $studentModulesRoles[] = [
                    'student_modules_roles_id' => (string) Str::uuid(),
                    'role_id' => $role,
                    'user_id' => $user,
                    'module_id' => $module,
                    'expired_date' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('student_modules_roles')->insert($studentModulesRoles);
    }
}
