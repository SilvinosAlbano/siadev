@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Students</h3>
        <ul>
            <li><a href="/home">Home</a></li>
            <li>All Students</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Student Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Students Data</h3>
                </div>
                {{-- @if ($user->canAccess('create', 'admission_form_student')) --}}
                @if (Auth::user()->canAccess('create', 'admission_form_student') ||
                        Auth::user()->canAccess('admin', 'admission_form_student'))
                    <div class=" col-xl-2 col-lg-4 col-12 form-group">
                        <a href="/admission_form_student" class="btn-fill-md text-light bg-dark-pastel-green"> <svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                            </svg> Adicionar</a>
                    </div>
                @endif
            </div>
            {{-- <form class="mg-b-20">
                <div class="row gutters-8">
                    <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Class ..." class="form-control">
                    </div>
                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                        <button type="submit" class="fw-btn-fill btn-gradient-yellow ">SEARCH</button>
                    </div>
                </div>
            </form> --}}
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input checkAll">
                                    <label class="form-check-label">Name</label>
                                </div>
                            </th>
                            <th>Gender</th>
                            <th>departamento</th>
                            <th>Semester</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">{{ $student->complete_name }}</label>
                                    </div>
                                </td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->departamento->departamento ?? 'N/A' }}</td>
                                <td>{{ $student->semester->semester_name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('students.show', ['student_id' => $student->student_id]) }}">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Student Table Area End Here -->
@endsection
