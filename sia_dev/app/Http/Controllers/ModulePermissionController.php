<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Module;
use App\Models\StudentModulesRoles; // Adjust as needed

class ModulePermissionController extends Controller
{
    public function showAssignRolesForm()
    {
        $roles = Role::all();
        $modules = Module::all();

        return view('pages.users.assign_role', compact('roles', 'modules'));
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

                // Insert or update the student_modules_roles table
                StudentModulesRoles::updateOrCreate(
                    [
                        'role_id' => $roleId,
                        'user_id' => $request->user_id, // Ensure user_id is passed correctly
                    ],
                    [
                        'expired_date' => $expiresAt,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Roles assigned successfully!');
    }
}
