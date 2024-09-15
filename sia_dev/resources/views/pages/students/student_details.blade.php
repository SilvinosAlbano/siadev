@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Dados detalhados de estudante <strong>{{ $student->complete_name }}</strong></h3>
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="{{ route('students.index') }}">Lista Estudantes</a></li>
            <li>Detalhes do Estudante</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Student Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Sobre o Estudante</h3>
                </div>
                @if (auth()->user()->hasRole('admin') ||
                        auth()->user()->canAccess('create', 'students') ||
                        auth()->user()->canAccess('update', 'students'))
                    <a class="align-left btn btn-lg" href="#" id="editButton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg> Editar
                    </a>
                @endif
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('students.update', ['id_student' => $student->id_student]) }}" method="POST"
                enctype="multipart/form-data" id="studentForm">
                @csrf
                @method('PUT')

                <div class="single-info-details">
                    <div class="item-img mb-4">
                        @if ($student->student_image)
                            <img src="{{ asset('storage/asset/posts/' . $student->student_image) }}" alt="Student Image"
                                class="image-fluid" width="150">
                        @else
                            <img src="{{ asset('img/pessoa_neutra.png') }}" width="150" alt="Student Image">
                        @endif
                    </div>
                    <div class="item-content">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="complete_name">Nome Completo:</label>
                                <input type="text" name="complete_name" class="form-control"
                                    value="{{ $student->complete_name }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="gender">Sexo:</label>
                                <select name="gender" class="form-control" disabled>
                                    <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Masculino
                                    </option>
                                    <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Feminino
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="place_of_birth">Lugar de Nascimento:</label>
                                <input type="text" name="place_of_birth" class="form-control"
                                    value="{{ $student->place_of_birth }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="date_of_birth">Data de Nascimento:</label>
                                <input type="text" name="date_of_birth" class="form-control"
                                    value="{{ $student->date_of_birth }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="id_departamento">Departamento:</label>
                                <select name="id_departamento" id="id_departamento" class="form-control" disabled>
                                    @foreach ($modelDepartamentos as $dept)
                                        <option value="{{ $dept->id_departamento }}"
                                            {{ optional($student->curriculoEstudante->programaEstudo->departamento)->id_departamento == $dept->id_departamento ? 'selected' : '' }}>
                                            {{ $dept->departamento }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="semester_id">Semestre:</label>
                                <select name="semester_id" id="semester_id" class="form-control" disabled>
                                    @foreach ($semestres as $sems)
                                        <option value="{{ $sems->semester_id }}"
                                            {{ optional($student->curriculoEstudante->semestre)->semester_id == $sems->semester_id ? 'selected' : '' }}>
                                            {{ $sems->semester_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="nre">NRE:</label>
                                <input type="text" name="nre" class="form-control" value="{{ $student->nre }}"
                                    readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="start_year">Ano Início:</label>
                                <input type="text" name="start_year" class="form-control"
                                    value="{{ $student->start_year }}" readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="observation">Observação:</label>
                                <textarea name="observation" class="form-control" rows="3" readonly>{{ $student->observation }}</textarea>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            @if (Auth::user()->canAccess('create', 'admission_form_student') ||
                                    Auth::user()->canAccess('admin', 'admission_form_student'))
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow" id="saveButton"
                                    disabled>Salvar Alterações</button>
                            @else
                                <a href="{{ route('students.index') }}"
                                    class="btn-fill-md radius-4 text-light bg-orange-red">Voltar à Lista</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Student Details Area End Here -->

    <script>
        document.getElementById('editButton').addEventListener('click', function(e) {
            e.preventDefault();
            // Enable all form fields
            document.querySelectorAll('#studentForm input, #studentForm select, #studentForm textarea').forEach(
                function(element) {
                    element.removeAttribute('readonly');
                    element.removeAttribute('disabled');
                });
            // Enable the Save button
            document.getElementById('saveButton').removeAttribute('disabled');
        });
    </script>

@endsection
