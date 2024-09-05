<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesModulesUsersAndStudentModulesRolesTables extends Migration
{
    public function up()
    {
        // Create roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id_roles')->primary();
            $table->string('role_name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create modules table
        Schema::create('modules', function (Blueprint $table) {
            $table->uuid('id_module')->primary();
            $table->string('module_name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create users table
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->uuid('student_id')->nullable();
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });

        // Create student_modules_roles table
        Schema::create('student_modules_roles', function (Blueprint $table) {
            $table->uuid('student_modules_roles_id')->primary();
            $table->uuid('role_id');
            $table->uuid('user_id');
            $table->uuid('module_id');
            $table->date('expired_date')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('role_id')->references('id_roles')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('module_id')->references('id_module')->on('modules')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Drop tables in reverse order to avoid foreign key constraint issues
        Schema::dropIfExists('student_modules_roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('roles');
    }
}
