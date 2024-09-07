<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Semester;
use App\Models\ModelDepartamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $semesters = Semester::all();
        $modelDepartamentos= ModelDepartamento::all();
        $students = Student::all();
        // $students = Student::with('roles', 'modules', 'student', 'docente')->paginate(10);
        return view('pages.students.all_students', compact('students', 'semesters', 'modelDepartamentos'));
    }

    public function create()
    {
        $semesters = Semester::all();
        $modelDepartamentos= ModelDepartamento::all();
        return view('pages.students.admission_form_student', compact('semesters', 'modelDepartamentos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'nre' => 'required|string|max:50',
            'faculty' => 'required|string|max:255',
            'departamento_id' => 'required|string|max:255',
            'semester_id' => 'required|string|max:255',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'observation' => 'nullable|string',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('student_image')) {
            $imagePath = $request->file('student_image')->store('student_images');
            $validated['student_image'] = $imagePath;
        }

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    public function show($student_id)
    {
        $student = Student::with(['departamento', 'semester'])->findOrFail($student_id);
        $semesters = Semester::all();
        $modelDepartamentos= ModelDepartamento::all();
        return view('pages.students.student_details', compact('student', 'semesters', 'modelDepartamentos'));
    }

    public function edit(Student $student)
    {
        return view('pages.students.edit_estudent', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'nre' => 'required|string|max:50',
            'faculty' => 'required|string|max:255',
            'departamento_id' => 'required|integer',
            'semester' => 'required|integer|in:1,2,3',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'observation' => 'nullable|string',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('student_image')) {
            if ($student->student_image) {
                Storage::delete($student->student_image);
            }
            $imagePath = $request->file('student_image')->store('student_images');
            $validated['student_image'] = $imagePath;
        }

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        if ($student->student_image) {
            Storage::delete($student->student_image);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
