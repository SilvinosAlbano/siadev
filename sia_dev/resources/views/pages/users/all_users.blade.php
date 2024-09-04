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
                    <h3>All Users</h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Module Associated</th>
                            <th>Roles for Module</th>
                            <th>Data Expired</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->user_id }}</td> <!-- Updated field name if using UUID -->
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    @foreach ($user->modules as $module)
                                        {{ $module->module_name }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        @foreach ($role->modules as $module)
                                            {{ $role->name }} - {{ $module->module_name }}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        @foreach ($role->modules as $module)
                                            {{ $role->pivot->expires_at }}<br>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('users.show', ['user' => $user->user_id]) }}">Ver</a>
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', ['user' => $user->user_id]) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <!-- Users Table Area End Here -->
@endsection
