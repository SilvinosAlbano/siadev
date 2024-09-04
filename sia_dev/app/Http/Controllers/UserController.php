<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\ModulePermission;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Get users with their roles and permissions
        $users = User::with('roles', 'modules')->paginate(10);

        return view('pages.users.all_users', compact('users'));
    }
    
    // In your controller method
    public function show($user)
    {
        // Fetch user details using $user
        $user = User::findOrFail($user);
        return view('pages.users.user_details', compact('user'));
    }

}
