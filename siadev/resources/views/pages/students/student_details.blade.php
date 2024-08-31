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
                                <label for="complete_name">Name:</label>
                                <input type="text" name="complete_name" class="form-control"
                                    value="{{ $student->complete_name }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="gender">Gender:</label>
                                <select name="gender" class="form-control" disabled>
                                    <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="place_of_birth">Place of Birth:</label>
                                <input type="text" name="place_of_birth" class="form-control"
                                    value="{{ $student->place_of_birth }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="date_of_birth">Date of Birth:</label>
                                <input type="text" name="date_of_birth" class="form-control"
                                    value="{{ $student->date_of_birth }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="department_id">Department:</label>
                                <select name="department_id" class="form-control" disabled>
                                    <option value="{{ $student->department_id }}">{{ $student->department }}</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="semester_id">Semester:</label>
                                <select name="semester_id" class="form-control" disabled>
                                    <option value="{{ $student->semester_id }}">{{ $student->semester }}</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="nre">NRE:</label>
                                <input type="text" name="nre" class="form-control" value="{{ $student->nre }}"
                                    readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="start_year">Start Year:</label>
                                <input type="text" name="start_year" class="form-control"
                                    value="{{ $student->start_year }}" readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" class="form-control" value="{{ $student->address }}"
                                    readonly>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" name="phone" class="form-control" value="{{ $student->phone }}"
                                    readonly>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="observation">Observation:</label>
                                <textarea name="observation" class="form-control" rows="3" readonly>{{ $student->observation }}</textarea>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-lg btn-primary" id="saveButton" disabled>Save
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
