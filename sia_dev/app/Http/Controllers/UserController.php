<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
         // Get users with their roles, modules, students, and docentes
        $users = User::with('roles', 'modules', 'student', 'docente')->paginate(10);
        return view('pages.users.all_users', compact('users'));
    }

    public function show($user)
    {
        // Fetch user details using $user
        $user = User::with('roles', 'modules','student', 'docente')->findOrFail($user);
        return view('pages.users.user_details', compact('user'));
    }


}
