@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Students</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Student Details</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Student Details Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Sobre Estudante</h3>
                </div>
                <a class="align-left" href="#" id="editButton"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
            </div>

            <form action="{{ route('students.update', ['student_id' => $student->student_id]) }}" method="POST"
                enctype="multipart/form-data" id="studentForm">
                @csrf
                @method('PUT')

                <div class="single-info-details">
                    <div class="item-img mb-4">
                        <img src="{{ asset('storage/' . $student->student_image) }}" alt="student" class="rounded-circle"
                            width="150">
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
                                    <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female
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
                                <label for="departamento_id">Departamento:</label>
                                <select name="departamento_id" class="form-control" disabled>

                                    @foreach ($modelDepartamentosas $dept)
                                        <option value="{{ $student->departamento_id }}"
                                            {{ $student->departamento_id == $dept->departamento_id ? 'selected' : '' }}>
                                            {{ $dept->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="semester_id">Semestre:</label>
                                <select name="semester_id" class="form-control" disabled>
                                    < @foreach ($semesters as $sems)
                                        <option value="{{ $student->departamento_id }}"
                                            {{ $student->semester_id == $sems->semester_id ? 'selected' : '' }}>
                                            {{ $sems->semester_name }}</option>
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
                            {{-- <div class="col-md-6 form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" class="form-control" value="{{ $student->address }}"
                                    readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" name="phone" class="form-control" value="{{ $student->phone }}"
                                    readonly>
                            </div> --}}
                            <div class="col-md-12 form-group">
                                <label for="observation">Observação:</label>
                                <textarea name="observation" class="form-control" rows="3" readonly>{{ $student->observation }}</textarea>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow" id="saveButton" disabled>Save
                                Changes</button>
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
