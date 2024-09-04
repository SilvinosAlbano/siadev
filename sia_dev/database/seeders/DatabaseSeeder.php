<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call RoleSeeder and UserSeeder
        $this->call([
            DepartmentSeeder::class,
            SemesterSeeder::class,
            StudentSeeder::class,
            StudentUserSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            ModulePermissionsTableSeeder::class,
        ]);
    }
}
