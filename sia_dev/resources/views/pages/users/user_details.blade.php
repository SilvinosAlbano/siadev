@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area mb-4">
        <h3>User Details for <strong>{{ $user->username }}</strong></h3>
        <ul class="breadcrumb">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="{{ route('users.index') }}">User List</a></li>
            <li class="active">User Details</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- User Details Area Start Here -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>About User</h4>
                {{-- Uncomment the following if you want to include an edit button --}}
                {{-- <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-warning btn-lg">
                    <i class="bi bi-pencil-square"></i> Edit
                </a> --}}
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <strong>Name:</strong>
                    <p>
                        @if ($user->tipo_usuario === 'Estudante')
                            {{ optional($user->student)->complete_name ?? 'No name available' }}
                        @elseif ($user->tipo_usuario === 'Docente')
                            {{ optional($user->docente)->nome_docente ?? 'No name available' }}
                        @else
                            {{ 'Unknown type' }}
                        @endif
                    </p>
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Username:</strong>
                    <p>{{ $user->username }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Email:</strong>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Type:</strong>
                    <p>{{ ucfirst($user->tipo_usuario) }}</p>
                </div>
            </div>

            <hr>

            <h5 class="mb-3">Modules and Roles</h5>
            @forelse($user->modules as $module)
                <div class="mb-4">
                    <h6>{{ $module->module_name }}</h6>
                    <p><strong>Description:</strong> {{ $module->description }}</p>
                    @php
                        $role = $user->roles->where('pivot.module_id', $module->id_module)->first();
                    @endphp
                    <p><strong>Role:</strong> {{ $role ? $role->role_name : 'No role assigned' }}</p>
                </div>
                <hr>
            @empty
                <p>No modules assigned to this user.</p>
            @endforelse

            <!-- Actions -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
    <!-- User Details Area End Here -->
@endsection
