@extends('app')

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
                    <h3>About Me</h3>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">...</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                        <a class="dropdown-item" href="#" id="editButton"><i
                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>

            <form action="{{ route('students.student_details', ['student_id' => $student->id]) }}" method="POST"
                enctype="multipart/form-data" id="studentForm">
                @csrf
                @method('PUT')

                <div class="single-info-details">
                    <div class="item-img">
                        <img src="{{ asset('storage/' . $student->student_image) }}" alt="student">
                    </div>
                    <div class="item-content">
                        <div class="header-inline item-header">
                            <h3 class="text-dark-medium font-medium">{{ $student->complete_name }}</h3>
                        </div>
                        <p>
                            <textarea name="observation" class="form-control" rows="3" readonly>{{ $student->observation }}</textarea>
                        </p>
                        <div class="info-table table-responsive">
                            <table class="table text-nowrap">
                                <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td><input type="text" name="complete_name" class="form-control"
                                                value="{{ $student->complete_name }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Gender:</td>
                                        <td>
                                            <select name="gender" class="form-control" disabled>
                                                <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Place of Birth:</td>
                                        <td><input type="text" name="place_of_birth" class="form-control"
                                                value="{{ $student->place_of_birth }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth:</td>
                                        <td><input type="text" name="date_of_birth" class="form-control"
                                                value="{{ $student->date_of_birth }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Department:</td>
                                        <td>
                                            <select name="department_id" class="form-control" disabled>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"
                                                        {{ $student->department_id == $department->id ? 'selected' : '' }}>
                                                        {{ $department->department_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Semester:</td>
                                        <td>
                                            <select name="semester_id" class="form-control" disabled>
                                                @foreach ($semesters as $semester)
                                                    <option value="{{ $semester->id }}"
                                                        {{ $student->semester_id == $semester->id ? 'selected' : '' }}>
                                                        {{ $semester->semester_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>NRE:</td>
                                        <td><input type="text" name="nre" class="form-control"
                                                value="{{ $student->nre }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Start Year:</td>
                                        <td><input type="text" name="start_year" class="form-control"
                                                value="{{ $student->start_year }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td>
                                        <td><input type="text" name="address" class="form-control"
                                                value="{{ $student->address }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Phone:</td>
                                        <td><input type="text" name="phone" class="form-control"
                                                value="{{ $student->phone }}" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary" id="saveButton" disabled>Save Changes</button>
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
