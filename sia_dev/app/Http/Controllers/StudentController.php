<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Semester;
use App\Models\ModelDepartamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $semesters = Semester::all();
        $modelDepartamentos = ModelDepartamento::all();
        $students = Student::with(['departamento', 'semester'])->paginate(10); // Use with for eager loading and paginate
        
        return view('pages.students.all_students', compact('students', 'semesters', 'modelDepartamentos'));
    }
    

    public function create()
    {
        $semesters = Semester::all();
        $modelDepartamentos = ModelDepartamento::all();
        return view('pages.students.admission_form_student', compact('semesters', 'modelDepartamentos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'nre' => 'required|string|max:50',
            'faculty' => 'required|string|max:255',
            'departamento_id' => 'required|string|max:255', // Ensure this matches the form field
            'semester_id' => 'required|string|max:255', // Ensure this matches the form field
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'observation' => 'nullable|string',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('student_image')) {
            $image = $request->file('student_image');
            $student_image = $image->hashName();
            $image->storeAs('public/asset/posts', $student_image);
            $validatedData['student_image'] = $student_image;
        }

         // Create the student
         $student = Student::create([
            'student_id' => (string) Str::uuid(),
            'complete_name' => $validatedData['complete_name'],
            'gender' => $validatedData['gender'],
            'place_of_birth' => $validatedData['place_of_birth'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'nre' => $validatedData['nre'],
            'departamento_id' => $validatedData['departamento_id'],
            'semester_id' => $validatedData['semester_id'],
            'start_year' => $validatedData['start_year'],
            'student_image' => $request->file('student_image') ? $request->file('student_image')->store('students') : null,
            'observation' => $validatedData['observation'],
        ]);

         // Create the associated user - Apeu hare Tau iha nemos iha Docentes nian
         User::create([
            'user_id' => (string) Str::uuid(),
            'username' => $student->nre,
            'email' => null, // Set email to null or receive it from request
            'password' => Hash::make('defaultpassword'), // You may want to create a random password or handle it otherwise
            'docente_student_id' => $student->student_id,
            'tipo_usuario' => 'Estudante', // Assuming 'Estudante' is a valid type for 'tipo_usuario'
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    public function show($student_id)
    {
        $student = Student::with(['departamento', 'semester'])->findOrFail($student_id);
        $semesters = Semester::all();
        $modelDepartamentos = ModelDepartamento::all();
        return view('pages.students.student_details', compact('student', 'semesters', 'modelDepartamentos'));
    }

    public function edit(Student $student)
    {
        return view('pages.students.edit_estudent', compact('student'));
    }

    public function update(Request $request, $student_id)
    {
        // Validate the input
        $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'nre' => 'required|string|max:50',
            'departamento_id' => 'required|exists:departamento,id_departamento',
            'semester_id' => 'required|exists:semesters,semester_id',
            'start_year' => 'required|integer',
            'observation' => 'nullable|string',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the student by ID
        $student = Student::findOrFail($student_id);

        // Handle image upload if provided
        if ($request->hasFile('student_image')) {
            // Delete the old image if exists
            if ($student->student_image) {
                Storage::delete('public/asset/posts/' . $student->student_image);
            }

            // Store the new image
            $image = $request->file('student_image');
            $student_image = $image->hashName(); // Generate a unique name for the image
            $image->storeAs('public/asset/posts', $student_image); // Store the image
            $student->student_image = $student_image;
        }

        // Update the student record
        $student->complete_name = $request->complete_name;
        $student->gender = $request->gender;
        $student->place_of_birth = $request->place_of_birth;
        $student->date_of_birth = $request->date_of_birth;
        $student->nre = $request->nre;
        $student->departamento_id = $request->departamento_id;
        $student->semester_id = $request->semester_id;
        $student->start_year = $request->start_year;
        $student->observation = $request->observation;
        $student->save();

        // Redirect back with success message
        return redirect()->route('students.show', ['student_id' => $student_id])->with('success', 'Student updated successfully!');
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
