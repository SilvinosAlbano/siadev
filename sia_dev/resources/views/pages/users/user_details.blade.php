@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">User Details</h1>

        <!-- User Details -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">User Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Name:</strong>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Username:</strong>
                        <p>{{ $user->username }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong>Email:</strong>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modules and Roles -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Modules and Roles</h5>
            </div>
            <div class="card-body">
                @forelse($user->modules as $module)
                    <div class="mb-3">
                        <h6>{{ $module->module_name }}</h6>
                        <p><strong>Description:</strong> {{ $module->description }}</p>
                        @php
                            $role = $user->roles->where('id_roles', $module->pivot->role_id)->first();
                        @endphp
                        <p><strong>Role:</strong> {{ $role ? $role->role_name : 'No role assigned' }}</p>
                        <hr>
                    </div>
                @empty
                    <p>No modules assigned to this user.</p>
                @endforelse
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-warning">Edit</a>
            {{-- <form action="{{ route('users.destroy', $user->user_id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form> --}}
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
