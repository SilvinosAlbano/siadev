@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Students</h3>
        <ul>
            <li><a href="/home">Home</a></li>
            <li>Todos Listas Estudante</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Student Table Area Start Here -->
    <div class="card height-auto">
          <div class="card-header shadow bg-white">
            <div class="card-title">
                <span>

                </span>     
                        
                <span>
                  
                </span>


                <div class="ui-btn-wrap">
                            <ul>
                               

                                <li>
                                     <div class="col-lg-12 col-12 form-group mg-t-30">
                                        <form action="/import-excel" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="from-group">
                                                <label for="file">Submete Lista estudante com formato (xlsx,xls,csv)</label>
                                                <input type="file" class="form-control-file" name="excel_file" id="file">
                                            </div>
                                            <button type="submit" class="btn-fill-md text-light bg-dodger-blue"> <i class="fas fa-file-excel"></i> Upload</button>
                                        </form>
                                    </div>
                                 </li>
                            </ul>
                 </div>
            </div>
        </div>
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Tabelas Estudante ICS</h3>
                </div>
                <!-- @if (Auth::user()->canAccess('create', 'admission_form_student') ||
                        Auth::user()->canAccess('admin', 'admission_form_student'))  -->
                        <!-- @endif -->
                        <li>
                            <a class="btn-fill-md text-light bg-dodger-blue" href="/students/create"> Inserir Novo <i class="fas fa-plus text-orange-peel"></i></a>
                        </li>
            </div>

            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
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
                                <td>{{ $student->student->complete_name }}</td>
                                <td>{{ $student->student->gender }}</td>
                                <td>{{ $student->student->place_of_birth }}</td>
                                <td>{{ $student->student->date_of_birth }}</td>
                                <td>{{ $student->student->nre }}</td>
                                <td>{{ $student->semestre->periodo ?? 'N/A' }}</td>
                                <td>{{ $student->programaEstudo->nome_programa ?? 'N/A' }}</td>
                                <td>{{ $student->programaEstudo->departamento->nome_departamento ?? 'N/A' }}</td>
                                <td>
                                    {{-- @if (Auth::user()->canAccess('edit', 'student_details')) --}}
                                    <a href="{{ route('students.edit', ['id_student' => $student->id_student]) }}"
                                        class="btn btn-primary btn-lg">Edit</a>
                                    {{-- @endif --}}
                                    {{-- @if (Auth::user()->canAccess('delete', 'students')) --}}
                                    <form action="{{ route('students.destroy', ['id_student' => $student->id_student]) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-lg"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
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
