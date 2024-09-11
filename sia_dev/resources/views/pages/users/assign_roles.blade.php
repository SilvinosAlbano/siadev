@extends('layouts.app')

@section('title', 'Roles and Permissions')

@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Roles and Permissions</h3>
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="{{ route('users.index') }}">User List</a></li>
            <li>Roles and Permissions</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Roles and Permissions Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Manage Roles and Permissions for {{ $user->username }}</h3>
                </div>
            </div>

            <form action="{{ route('assign.roles', ['user' => $user->user_id]) }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Module</th>
                                @foreach ($roles as $role)
                                    <th class="text-center">{{ $role->role_name }}</th>
                                @endforeach
                                <th>Expiry Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr>
                                    <td>{{ $module->module_name }}</td>
                                    @foreach ($roles as $role)
                                        <td class="text-center">
                                            @php
                                                $isChecked =
                                                    $userRolesByModule->has($module->id_module) &&
                                                    $userRolesByModule[$module->id_module]->contains(
                                                        'id_roles',
                                                        $role->id_roles,
                                                    );
                                            @endphp
                                            <input type="checkbox" name="roles[{{ $module->id_module }}][]"
                                                value="{{ $role->id_roles }}" {{ $isChecked ? 'checked' : '' }}>
                                        </td>
                                    @endforeach
                                    <td>
                                        @php
                                            $expiryDate = $userRolesByModule->has($module->id_module)
                                                ? $userRolesByModule[$module->id_module]->firstWhere(
                                                        'id_roles',
                                                        $role->id_roles,
                                                    )->pivot->expired_date ?? ''
                                                : '';
                                        @endphp
                                        <input type="date" name="expires_at[{{ $module->id_module }}]"
                                            class="form-control" value="{{ $expiryDate }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group text-right">
                    <div class="d-flex justify-content-between mt-4">
                        {{-- <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-warning">Edit</a> --}}

                        <a href="{{ route('users.index') }}" class="btn-fill-md radius-4 text-light bg-orange-red">Back to
                            List</a>
                        <button type="submit" class="btn-fill-md text-light bg-dark-pastel-green">Assign Roles</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Roles and Permissions Form Area End Here -->
@endsection
