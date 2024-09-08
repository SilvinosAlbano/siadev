@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Users</h3>
        <ul>
            <li><a href="/home">Home</a></li>
            <li>All Users</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Users Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Users Data</h3>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">...</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>
            <form class="mg-b-20">
                <div class="row gutters-8">
                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Type ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <!-- Users Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Type</th>
                            <th>Modules & Roles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    @if ($user->student)
                                        {{ $user->student->complete_name }}
                                    @elseif ($user->docente)
                                        {{ $user->docente->nome_docente }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->tipo_usuario }}</td>
                                <td>
                                    @foreach ($user->modules as $module)
                                        <div>
                                            <strong>{{ $module->module_name }}:</strong>
                                            @php
                                                $role = $user->roles
                                                    ->where('id_roles', $module->pivot->role_id)
                                                    ->first();
                                            @endphp
                                            <span class="badge bg-info text-white">
                                                {{ $role ? $role->role_name : 'No role assigned' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('users.show', $user->user_id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('users.edit', $user->user_id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination Links -->
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <!-- Users Table Area End Here -->
@endsection
