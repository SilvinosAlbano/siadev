<?php

namespace App\Http\Controllers;

use App\Models\ModelStudent;
use App\Models\ModelSemestre;
use App\Models\ModelDepartamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ModelUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        // Fetch all students with relationships
        $students = ModelStudent::with([
            'curriculoEstudante.semestre',
            'curriculoEstudante.programaEstudo.departamento'
        ])->paginate(10);

        // Fetch all semesters
        $semestres = ModelSemestre::all();

        // Return view with variables
        return view('pages.students.all_students', compact('students', 'semestres'));
    }



    public function create()
    {
        $semesters = ModelSemestre::all();
        $modelDepartamentos = ModelDepartamento::all();
        return view('pages.students.admission_form_student', compact('semestre', 'modelDepartamentos'));
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
            'id_departamento' => 'required|integer', // Ensure this matches the form field
            'semester_id' => 'required|integer', // Ensure this matches the form field
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
        $student = ModelStudent::create([
            'id_student' => (string) Str::uuid(),
            'complete_name' => $validatedData['complete_name'],
            'gender' => $validatedData['gender'],
            'place_of_birth' => $validatedData['place_of_birth'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'nre' => $validatedData['nre'],
            'id_departamento' => $validatedData['id_departamento'],
            'semester_id' => $validatedData['semester_id'],
            'start_year' => $validatedData['start_year'],
            'student_image' => $request->file('student_image') ? $request->file('student_image')->store('students') : null,
            'observation' => $validatedData['observation'],
        ]);

        // Create the associated user
        ModelUser::create([
            'user_id' => (string) Str::uuid(),
            'username' => $student->nre,
            'email' => null, // Set email to null or receive it from request
            'password' => Hash::make('defaultpassword'), // You may want to create a random password or handle it otherwise
            'docente_id_student' => $student->id_student,
            'tipo_usuario' => 'Estudante',
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    public function show($id_student)
    {
        // Retrieve the specific student with related data
        $student = ModelStudent::with([
            'curriculoEstudante.semestre',
            'curriculoEstudante.programaEstudo.departamento'
        ])->findOrFail($id_student);

        // Fetch all semesters and departments for possible dropdowns or additional information
        $semestres = ModelSemestre::all();
        $modelDepartamentos = ModelDepartamento::all();

        // Return the view with the student and related data
        return view('pages.students.student_details', compact('student', 'semestres', 'modelDepartamentos'));
    }


    public function edit(ModelStudent $student)
    {
        return view('pages.students.edit_estudent', compact('student'));
    }

    public function update(Request $request, $id_student)
    {
        $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'nre' => 'required|string|max:50',
            'id_departamento' => 'required|exists:departamentos,id_departamento',
            'semester_id' => 'required|exists:semesters,id_semester',
            'start_year' => 'required|integer',
            'observation' => 'nullable|string',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student = ModelStudent::findOrFail($id_student);


        if ($request->hasFile('student_image')) {
            if ($student->student_image) {
                Storage::delete('public/asset/posts/' . $student->student_image);
            }

            $image = $request->file('student_image');
            $student_image = $image->hashName();
            $image->storeAs('public/asset/posts', $student_image);
            $student->student_image = $student_image;
        }

        $student->complete_name = $request->complete_name;
        $student->gender = $request->gender;
        $student->place_of_birth = $request->place_of_birth;
        $student->date_of_birth = $request->date_of_birth;
        $student->nre = $request->nre;
        $student->id_departamento = $request->id_departamento;
        $student->semester_id = $request->semester_id;
        $student->start_year = $request->start_year;
        $student->observation = $request->observation;
        $student->save();

        return redirect()->route('students.show', ['id_student' => $id_student])->with('success', 'Student updated successfully!');
    }

    public function destroy(ModelStudent $student)
    {
        if ($student->student_image) {
            Storage::delete('public/asset/posts/' . $student->student_image);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
