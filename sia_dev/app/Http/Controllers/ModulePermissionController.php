<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\ModulePermission; // Import the model

class ModulePermissionController extends Controller
{
    public function showAssignRolesForm()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $modules = ['Students', 'Teachers', 'Departments', 'Classes', 'Subjects', 'Attendances'];

        return view('pages.users.assign_role', compact('roles', 'permissions', 'modules'));
    }

    public function assignRoles(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'roles.*' => 'array',
            'roles.*.*' => 'uuid',
            'expires_at.*' => 'required|date',
        ]);

        // Process and save data
        foreach ($request->roles as $module => $roleIds) {
            foreach ($roleIds as $roleId) {
                $expiresAt = $request->input("expires_at.$module");

                // Insert or update the module_permissions table
                ModulePermission::updateOrCreate(
                    [
                        'module_name' => $module,
                        'role_id' => $roleId,
                        // Other necessary fields
                    ],
                    [
                        'expires_at' => $expiresAt,
                        // Other necessary fields
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Roles assigned successfully!');
    }
}
