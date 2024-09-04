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

            @if ($user)
                <p><strong>ID:</strong> {{ $user->id }}</p>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <!-- Add other user details here -->

                <!-- If you have related data -->
                @if ($user->roles)
                    <h3>Roles:</h3>
                    <ul>
                        @foreach ($user->roles as $role)
                            <li>{{ $role->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No roles assigned.</p>
                @endif
            @else
                <p>User not found.</p>
            @endif


        </div>
    </div>
    <!-- Users Table Area End Here -->
@endsection
