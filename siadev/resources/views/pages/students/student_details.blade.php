@extends('app')

@section('title', 'Student Details')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Students</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Student Details</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
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
                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>
            <div class="single-info-details">
                <div class="item-img">
                    <!-- Assuming the student's image is stored with a path in the database -->
                    <img src="{{ asset('storage/' . $student->student_image) }}" alt="student">
                </div>
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium">{{ $student->complete_name }}</h3>
                        <div class="header-elements">
                            <ul>
                                <li><a href="#"><i class="far fa-edit"></i></a></li>
                                <li><a href="#"><i class="fas fa-print"></i></a></li>
                                <li><a href="#"><i class="fas fa-download"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <p>{{ $student->observation }}</p>
                    <div class="info-table table-responsive">
                        <table class="table text-nowrap">
                            <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->complete_name }}</td>
                                </tr>
                                <tr>
                                    <td>Gender:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->gender }}</td>
                                </tr>
                                <tr>
                                    <td>Place of Birth:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->place_of_birth }}</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->date_of_birth }}</td>
                                </tr>
                                <tr>
                                    <td>Department:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->department->department_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Semester:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->semester->semester_name }}</td>
                                </tr>
                                <tr>
                                    <td>NRE:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->nre }}</td>
                                </tr>
                                <tr>
                                    <td>Start Year:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->start_year }}</td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->address }}</td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td class="font-medium text-dark-medium">{{ $student->phone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Student Details Area End Here -->
@endsection
