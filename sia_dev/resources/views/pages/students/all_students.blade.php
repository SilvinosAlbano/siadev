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
                @if (Auth::user()->canAccess('create', 'admission_form_student') ||
                        Auth::user()->canAccess('admin', 'admission_form_student'))
                    <div class="col-xl-2 col-lg-4 col-12 form-group">
                        <a href="/admission_form_student" class="btn-fill-md text-light bg-dark-pastel-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                            </svg> Adicionar</a>
                    </div>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Place of Birth</th>
                            <th>Date of Birth</th>
                            <th>NRE</th>
                            <th>Semester</th>
                            <th>Department</th>
                            <th>Programa de Estudo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                {{-- <td>{{ $student->id_student }}</td> --}}
                                <td>{{ $student->complete_name }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->place_of_birth }}</td>
                                <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }}</td>
                                <td>{{ $student->nre }}</td>
                                <td>{{ $student->curriculoEstudante->semestre->numero_semestre }}</td>
                                <td>{{ $student->curriculoEstudante->programaEstudo->departamento->nome_departamento }}</td>
                                <td>{{ $student->curriculoEstudante->programaEstudo->tipo_programa }}</td>
                                <td>
                                    {{-- @if (Auth::user()->canAccess('edit', 'edit_estudent')) --}}
                                    {{-- <a href="{{ route('students.edit', ['student' => $student->id_student]) }}" --}}
                                    {{-- class="btn btn-primary btn-sm">Edit</a> --}}
                                    {{-- @endif --}}
                                    {{-- @if (Auth::user()->canAccess('delete', 'students')) --}}
                                    {{-- <form action="{{ route('students.destroy', ['student' => $student->id_student]) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form> --}}
                                    {{-- @endif --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $students->links() }}
            </div>
        </div>
    </div>
    <!-- Student Table Area End Here -->
@endsection
