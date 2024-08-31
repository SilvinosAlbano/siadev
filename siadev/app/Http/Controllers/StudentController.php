<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('pages.students.all_students', compact('students'));
    }

    public function create()
    {
        return view('pages.students.admission_form_student');
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
            'department_id' => 'required|integer',
            'semester' => 'required|integer|in:1,2,3',
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
        $student = Student::with(['department', 'semester'])->findOrFail($student_id);
        return view('pages.students.student_details', compact('student'));
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
            'department_id' => 'required|integer',
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
