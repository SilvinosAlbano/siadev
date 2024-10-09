<?php

namespace App\Http\Controllers;

use App\Models\ModelStudent;
use App\Models\ModelSemestre;
use App\Models\ModelDepartamento;
use App\Models\ModelMatricula;
use App\Models\ModelProgramaEstudo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ModelUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;

class StudentController extends Controller
{
    // public function index()
    // {
    //     $students = ModelMatricula::with(['student', 'semestre', 'programaEstudo.departamento'])->paginate(10);
    //     // $students = ModelStudent::all();
    //     return view('pages.students.all_students', compact('students'));
    // }

    public function index()
    {
        $students = ModelMatricula::with(['student', 'semestre', 'programaEstudo.departamento'])
            ->whereHas('student')  // Ensures only students with related data are fetched
            ->paginate(10);

        return view('pages.students.all_students', compact('students'));
    }

    public function create()
    {
        $semestre = ModelSemestre::all();
      
        $programaEstudo = ModelProgramaEstudo::all(); // Ajustei o nome da variável
        return view('pages.students.admission_form_student', compact('semestre', 'programaEstudo'));
    }

    public function store(Request $request)
    {
        // $dateOfBirth = Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->format('Y-m-d');
        $validatedData = $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'place_of_birth' => 'required|string|max:255',
            // 'date_of_birth' => 'required|date_format:d/m/Y',
            'date_of_birth' => 'required|date',
            'nre' => 'required|string|max:50',
            'faculty' => 'required|string|max:255',
            'id_programa_estudo' => 'required|string', // Ensure this matches the form field
            'id_semestre' => 'required|string', // Ensure this matches the form field
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            // 'observation' => 'nullable|string',
            // 'student_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'id_programa_estudo' => $validatedData['id_programa_estudo'],
           'start_year' => $validatedData['start_year'],
            'student_image' => $request->file('student_image') ? $request->file('student_image')->store('students') : null,
            // 'observation' => $validatedData['observation']
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


        ModelMatricula::create([
            'id_matricula' => (string) Str::uuid(),
            'id_student' => $student->id_student,
            'id_programa_estudo' => $validatedData['id_programa_estudo'],
            'id_semestre' => $validatedData['id_semestre'],
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

   


    public function edit($id_student)
    {
        // Carregar o estudante com dados relacionados
        $student = ModelStudent::with(['matriculas.semestre', 'matriculas.programaEstudo.departamento'])->findOrFail($id_student);

        // Obter todos os departamentos e semestres disponíveis
        $modelDepartamentos = ModelDepartamento::all();
        $semesters = ModelSemestre::all();

        // Passar o estudante, departamentos e semestres para a view
        return view('pages.students.student_details', compact('student', 'modelDepartamentos', 'semesters'));
    }

    public function update(Request $request, $id_student)
    {
        $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'nre' => 'required|string|max:50',
            'id_departamento' => 'required|exists:departamento,id_departamento',
            'semester_id' => 'required|exists:semestre,id_semestre',
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
        $student->id_programa_estudo = $request->id_programa_estudo;
        $student->id_semestre = $request->id_semestre;
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

   

    public function import_excel_post(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);
    
        // Import the Excel file
        Excel::import(new StudentImport, $request->file('excel_file'));

        
        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }
    

    #start student materia
    public function MateriaEstudante($id)
    {
        $student = ModelStudent::with(['matriculas.semestre', 'matriculas.programaEstudo.departamento'])->findOrFail($id);
      
        return view('pages.students.estudante_materia.materia_estudante', compact('student'));
    }
    #end



     #start function departamento estudante
     public function Departamentoestudante($id_estudent) 
     {
        $student = ModelStudent::findOrFail($id_estudent);
        $prodi = DB::table('view_programa_estudo_estudante')
        ->where('id_student', $id_estudent)
        ->paginate(10);
        $estudanteDepartamento = DB::select("
        SELECT 
            a.id_departamento_estudante,
            a.id_student,
            c.id_faculdade,
            c.nome_faculdade,
            b.id_departamento,
            a.controlo_estado,
            b.nome_departamento
        FROM estudante_departamento a
        LEFT JOIN departamento b ON b.id_departamento = a.id_departamento
        LEFT JOIN faculdade c ON c.id_faculdade = b.id_faculdade
        WHERE a.id_student = ?
    ", [$id_estudent]);

        return view('pages.students.estudante_departamento.departamentoEstudante',compact('student','estudanteDepartamento','prodi'));
        
     }

     #end



       #start function Programa estudo estudante
       public function ProgramaEstudo($id_estudent) 
       {
          $student = ModelStudent::findOrFail($id_estudent);
          $prodi = DB::table('view_programa_estudo_estudante')
          ->where('id_student', $id_estudent)
          ->paginate(10);
         
  
          return view('pages.students.estudante_programa_estudo.programa_estudo',compact('student','prodi'));
          
       }
  
       #end


    #start student materia
        public function PagamentoEstudante($id)
        {
            $student = ModelStudent::findOrFail($id);
            $pagamento = DB::table('view_pagamento_estudante')
            ->where('id_student', $id)
            ->paginate(10);
            return view('pages.students.estudante_pagamento.pagamento',compact('student','pagamento'));
        }

        public function create_pagamento($id)
        {
            $departamento = DB::table('controlo_departamento_pagamento as a')
            ->select(
                'a.id_controlo_departamento',
                'b.id_departamento',
                'b.nome_departamento',
                'a.total_indice',
                'a.ano_academico',
                'a.estado'
            )
            ->leftJoin('departamento as b', 'b.id_departamento', '=', 'a.id_departamento')
            ->whereNull('a.estado')
            ->get();

            $student = ModelStudent::findOrFail($id);
            $semestre = ModelSemestre::all();
            return view('pages.students.estudante_pagamento.form_create_pagamento', compact('student','id','departamento','semestre'));
        }
    #end

}
