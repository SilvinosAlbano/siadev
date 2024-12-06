<?php

namespace App\Http\Controllers;

use App\Models\ModelUser;
use App\Models\ModelRole;
use App\Models\ModelModule;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{

    
    // Display the assign roles form for a specific user
    public function assignRolesForm($user)
    {
        $user = ModelUser::findOrFail($user);

        // Fetch roles and modules
        $roles = ModelRole::all();
        $modules = ModelModule::all();
        $userRoles = $user->roles()->withPivot('module_id', 'expired_date')->get(); // Get roles of the specific user

        // Prepare a list of module-role assignments for the user
        $userRolesByModule = $userRoles->groupBy('pivot.module_id');

        return view('pages.users.assign_roles', compact('user', 'roles', 'modules', 'userRolesByModule'));
    }
    // Assign roles to a specific user
   /*  public function assignRoles(Request $request, ModelUser $user)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'array',
            'expires_at' => 'required|array',
            'expires_at.*' => 'date|nullable',
        ]);

        // Detach existing roles for the user to avoid duplicates
        $user->roles()->detach();

        foreach ($request->roles as $moduleId => $roleIds) {
            foreach ($roleIds as $roleId) {
                $expiryDate = $request->expires_at[$moduleId] ?? null;

                // Attach new roles with expiry date
                $user->roles()->attach($roleId, [
                    'module_id' => $moduleId,
                    'expired_date' => $expiryDate,
                ]);
            }
        }

        return redirect()->route('assign.roles.form', $user->user_id)->with('success', 'Roles assigned successfully.');
    } */
    public function assignRoles(Request $request, ModelUser $user)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'array',
            'expires_at' => 'required|array',
            'expires_at.*' => 'date|nullable',
        ]);

        // Detach existing roles for the user to avoid duplicates
        $user->roles()->detach();

        foreach ($request->roles as $moduleId => $roleIds) {
            foreach ($roleIds as $roleId) {
                $expiryDate = $request->expires_at[$moduleId] ?? null;

                // Attach new roles with expiry date
                $user->roles()->attach($roleId, [
                    'module_id' => $moduleId,
                    'expired_date' => $expiryDate,
                ]);
            }
        }

        return redirect()->route('assign.roles.form', $user->user_id)->with('success', 'Roles assigned successfully.');
    }
}
