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
                        <a class="dropdown-item" href="/assign_role">
                            <i class="fa fa-solid fa-plus text-dark-pastel-green"></i> Adicionar</a>
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-solid fa-download text-orange-peel"></i>Exportar</a>
                    </div>
                </div>
            </div>
            <form class="mg-b-20">
                <div class="row gutters-8">
                    <div class="col-4-xxxl col-xl-4 col-lg-4 col-12 form-group">
                        <input type="text" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group">
                        <input type="text" placeholder="Search by Type ..." class="form-control">
                    </div>
                    <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group">
                        <input type="text" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group">
                        <input type="text" placeholder="Search by Type ..." class="form-control">
                    </div>
                    <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group">
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
                                    <a href="{{ route('users.show', ['user' => $user->user_id]) }}"
                                        class="btn btn-info btn-lg" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Ver detalhos do usuário"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-eye-fill"
                                            viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg></a>
                                    <a href="{{ route('assign.roles.form', ['user' => $user->user_id]) }}"
                                        class="btn btn-warning btn-lg" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Adicionar nova permissão ao usuário">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                            <path
                                                d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1" />
                                        </svg>
                                    </a>

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
