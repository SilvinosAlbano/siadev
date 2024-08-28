<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Department;
use App\Models\Semester;

class StudentController extends Controller
{
    // In StudentController.php
    public function index()
    {
        $students = Student::with(['department', 'semester'])->get();
        return view('pages.students.all_students', compact('students'));
    }


    public function show($student_id)
    {
        $student = Student::with(['department', 'semester'])->findOrFail($student_id);
        return view('pages.students.student_details', compact('student'));
    }

    // Add more methods for create, store, edit, update, destroy


}
