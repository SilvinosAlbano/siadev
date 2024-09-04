<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesAndPermissionsTables extends Migration
{
    public function up()
    {
        // Create 'roles' table with UUID primary key
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id_roles')->primary(); // UUID primary key
            $table->string('name');
            $table->string('guard_name')->default('web'); // For Laravel's auth system
            $table->timestamps();
        });

        // Create 'permissions' table with UUID primary key
        Schema::create('permissions', function (Blueprint $table) {
            $table->uuid('id_permissions')->primary(); // UUID primary key
            $table->string('name');
            $table->string('guard_name')->default('web');
            $table->timestamps();
        });

        // Create 'module_permissions' table with UUID primary key
        Schema::create('module_permissions', function (Blueprint $table) {
            $table->uuid('id_module_permissions')->primary(); // UUID primary key
            $table->uuid('module_id'); // Use module_id instead of module_name
            $table->foreign('module_id')->references('module_id')->on('modules')->onDelete('cascade'); // Ensure this matches with the 'modules' table
            $table->uuid('role_id');
            $table->foreign('role_id')->references('id_roles')->on('roles')->onDelete('cascade');
            $table->uuid('permission_id');
            $table->foreign('permission_id')->references('id_permissions')->on('permissions')->onDelete('cascade');
            $table->date('expires_at')->nullable();
            $table->timestamps();
        });
        


        // Create 'model_has_permissions' table with UUID model_id
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->uuid('model_id'); // id of user
            $table->string('model_type'); // usually App\Models\User
            $table->uuid('permission_id'); // Use UUID for permission_id
            $table->foreign('permission_id')->references('id_permissions')->on('permissions')->onDelete('cascade');
            $table->primary(['model_id', 'permission_id', 'model_type'], 'model_has_permissions_primary');
        });

        // Create 'model_has_roles' table with UUID model_id
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->uuid('model_id'); // id of user
            $table->string('model_type'); // usually App\Models\User
            $table->uuid('role_id'); // Use UUID for role_id
            $table->foreign('role_id')->references('id_roles')->on('roles')->onDelete('cascade');
            $table->date('expires_at')->nullable(); // Expiry date for the role
            $table->primary(['model_id', 'role_id', 'model_type'], 'model_has_roles_primary');
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('module_permissions');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
}
