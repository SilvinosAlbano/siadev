<?php

namespace App\Http\Controllers;

use App\Models\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = ModelUser::query();

        // Search by username or type
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                    ->orWhere('tipo_usuario', 'like', "%{$search}%");
            });
        }

        $users = $query->with(['roles', 'modules'])
            ->paginate(10);

        return view('pages.users.all_users', compact('users'));
    }

    public function show($user_id)
    {
        $user = ModelUser::with(['student', 'docente', 'roles', 'modules'])
            ->findOrFail($user_id);

        return view('pages.users.user_details', compact('user'));
    }

    public function edit($user_id)
    {
        $user = ModelUser::findOrFail($user_id);
        return view('pages.users.edit_user', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user_id . ',user_id',
            'email' => 'nullable|email|unique:users,email,' . $user_id . ',user_id',
            'password' => 'nullable|string|min:8|confirmed',
            'tipo_usuario' => 'required|string',
        ]);

        $user = ModelUser::findOrFail($user_id);

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->tipo_usuario = $request->input('tipo_usuario');
        $user->save();

        return redirect()->route('users.show', $user_id)
            ->with('success', 'User updated successfully!');
    }
}
