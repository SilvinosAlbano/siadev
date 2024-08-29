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

    /*  public function store(Request $request)
    {
        $validated = $request->validated();

        // Handle file upload
        if ($request->hasFile('student_image')) {
            $imagePath = $request->file('student_image')->store('student_images');
            $validated['student_image'] = $imagePath;
        }

        Student::create($validated);

        return redirect()->route('students.all_students')->with('success', 'Student created successfully!');
    } */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'nre' => 'required|string|max:50',
            'faculty' => 'required|string|max:255',
            'department_id' => 'required|integer', // Ensure this field is validated
            'semester' => 'required|integer|in:1,2,3', // Ensure this matches your semester options
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'observation' => 'nullable|string',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File validation
        ]);

        // Handle file upload
        if ($request->hasFile('student_image')) {
            $imagePath = $request->file('student_image')->store('student_images');
            $validated['student_image'] = $imagePath;
        }

        // Save the student data
        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    public function show($student_id)
    {
        $student = Student::with(['department', 'semester'])->findOrFail($student_id);
        return view('pages.students.student_details', compact('student'));
    }

    /* public function show(Student $student_id)
    {
        return view('students.student_details', compact('student'));
    }
 */
    public function edit(Student $student)
    {
        return view('students.edit_estudent', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validated();

        // Handle file upload
        if ($request->hasFile('student_image')) {
            // Delete old image if it exists
            if ($student->student_image) {
                Storage::delete($student->student_image);
            }
            $imagePath = $request->file('student_image')->store('student_images');
            $validated['student_image'] = $imagePath;
        }

        $student->update($validated);

        return redirect()->route('students.all_students')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        // Delete image if it exists
        if ($student->student_image) {
            \Storage::delete($student->student_image);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
