<?php

namespace App\Exports;
namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use App\Models\ModelStudent;
use App\Models\ModelSemestre;
use App\Models\ModelDepartamento;
use App\Models\ModelMatricula;
use App\Models\ModelLicencaEstudante;
use App\Models\ModelNaturalidadeEstudante;
use App\Models\ModelProgramaEstudo;
use App\Models\ModelsemestreEstudante;
use App\Models\ModelFinalista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ModelUser;
use App\Models\ModelIndicePagamento;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;
use App\Models\ModelPagamentoStudante;
use App\Models\ViewMunicipioPosto;
use App\Exports\PaymentsExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class StudentController extends Controller
{

    
    public function index()
    {
        $students = ModelMatricula::with(['student', 'semestre', 'programaEstudo.departamento'])
            ->whereHas('student')  // Ensures only students with related data are fetched
            ->paginate(10);

            $anos = DB::table('view_estudante')
            // ->where('id_departamento', $id) // Use the same $id for the department
            ->distinct()
            ->pluck('ano_inicio');

        return view('pages.students.all_students', compact('students','anos'));
    }
    public function getEstudanteGeral(Request $request)
    {
        $ano_inicio = $request->ano_inicio ?: date('Y');
        $id_student = $request->id_student;
        if ($request->ajax()) {
            $data = DB::table('view_estudante')
                ->when($ano_inicio, function ($query, $ano_inicio) {
                    $query->where('ano_inicio', $ano_inicio); // Filter by `ano_inicio` if provided
                })
                ->select('*'); // Select all columns

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('students.detail', $row->id_student);
                    // $deleteUrl = route('docentes.destroy', $row->id_student);

                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary">Detalho</a>';
                    $btn .= '';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function EstudanteNaoAtivo()
    {
       
            $anos = DB::table('view_estudante')
            // ->where('id_departamento', $id) // Use the same $id for the department
            ->distinct()
            ->pluck('ano_inicio');

        return view('pages.students.estudante_nao_ativo', compact('anos'));
    }

    public function getEstudanteNaoAtivo(Request $request)
{
    $ano_inicio = $request->ano_inicio ?: date('Y');
    $id_student = $request->id_student;

    if ($request->ajax()) {
        $data = DB::table('view_estudante')
            ->when($ano_inicio, function ($query, $ano_inicio) {
                $query->where('ano_inicio', $ano_inicio); // Filter by `ano_inicio` if provided
            })
            ->whereNotNull('controlo_estado') // Filter rows where `controlo_estado` is not null
            ->whereNull('estado')            // Filter rows where `estado` is null
            ->select('*');                   // Select all columns

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('students.detail', $row->id_student);
                // $deleteUrl = route('docentes.destroy', $row->id_student);

                $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary">Detalho</a>';
                $btn .= '';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

    
    public function EscolhaEstudante()
    {
        $estudante_departamento = DB::table('students as a')
        ->select(
            'h.id_departamento',
            'h.nome_departamento',
            DB::raw('COUNT(a.id_student) as total_estudante')
        )
        ->leftJoin('matricula as g', 'g.id_student', '=', 'a.id_student')
        ->leftJoin('programa_estudo as p', 'p.id_programa_estudo', '=', 'g.id_programa_estudo')
        ->leftJoin('departamento as h', 'h.id_departamento', '=', 'p.id_departamento')
        ->whereNotNull('h.id_departamento') // Exclude records where id_departamento is null
        ->groupBy('h.id_departamento', 'h.nome_departamento')
        ->get();

        return view('pages.students.escolha_estudante',compact('estudante_departamento'));
    }

    public function showDetailEscolhaEstudante($id)
    {
        // Fetch the student details from the view_estudante based on id_departamento
        $estudante = DB::table('view_estudante')
            ->where('id_departamento', $id)
            ->orderByDesc('created_at')
            ->first();
    
        // Check if the data was found
        if (!$estudante) {
            return redirect()->back()->with('error', 'Details not found.');
        }
    
        // Fetch unique ano_inicio values for the filter
        $anos = DB::table('view_estudante')
            ->where('id_departamento', $id) // Use the same $id for the department
            ->distinct()
            ->pluck('ano_inicio');
    
        return view('pages.students.dados_estudante_por_departamento', compact('estudante', 'anos','id'));
    }
    
    public function getEstudantedepartamento(Request $request)
    {
        $id_departamento = $request->id_departamento;
        $ano_inicio = $request->ano_inicio ?: date('Y'); // Define o ano atual como padrão se não for fornecido
        
        if ($request->ajax()) {
            $data = DB::table('view_estudante')
                ->where('id_departamento', $id_departamento) // Filtro pelo id_departamento
                ->when($ano_inicio, function ($query, $ano_inicio) {
                    $query->where('ano_inicio', $ano_inicio); // Aplica o filtro ano_inicio
                })
                ->select('*');
    
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('students.edit', $row->id_student);
                    $inserirUrl = route('students.detail', $row->id_student);
                    $deleteUrl = route('students.destroy', $row->id_student);
                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary">Editar</a>';
                    $btn .= ' <a href="' . $inserirUrl . '" class="input btn btn-info btn-sm">Detail</a>';
                    $btn .= ' <button type="button" class="delete btn btn-danger btn-sm" onclick="confirmDelete(\'' . $deleteUrl . '\')">Apagar</button>';
    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function ViewMonitoramentoFinalista()
    {
       
        $departamento = ModelDepartamento::all();

        return view('pages.students.estudante_finalista.monitoramento_finalista',compact('departamento'));
    }
    public function getMonitoramentoFinalista(Request $request)
    {
        if ($request->ajax()) {
            // Get filters from request
            $nomeDepartamento = $request->input('nome_departamento');
            $anoAcademico = $request->input('ano_academico');
    
            // Build the query with optional filters
            $data = DB::table('view_finalista_estudante')
                ->select('*');
    
            if ($nomeDepartamento) {
                $data->where('nome_departamento', 'LIKE', '%' . $nomeDepartamento . '%');
            }
    
            if ($anoAcademico) {
                $data->where('ano_academico', $anoAcademico);
            }
    
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // Initialize $btn
                    $btn = '';
    
                    // Add Detail button
                    $detailUrl = route('semestre_estudante', $row->id_student);
                    $btn .= '<a href="' . $detailUrl . '" class="detail btn btn-info btn-sm">Detail</a>';
    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    
    
    
    public function exportEstudantes(Request $request)
    {
        $id_departamento = $request->input('id_departamento');
        $ano_inicio = $request->input('ano_inicio');
    
        // Query filtered data
        $data = DB::table('view_estudante')
            ->where('id_departamento', $id_departamento)
            ->when($ano_inicio, function ($query, $ano_inicio) {
                return $query->where('ano_inicio', $ano_inicio);
            })
            ->get();
    
        // Prepare CSV
        $filename = "estudantes_{$id_departamento}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
    
        $columns = ['NRE','Nome', 'Sexo', 'Data Moris', 'Departamento',' Programa Estudo', 'Semestre', 'Ano Academico'];
    
        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Header row
    
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->nre,
                    $row->nome_estudante,
                    $row->sexo,
                    $row->data_moris,
                    $row->nome_departamento,
                    $row->nome_programa,
                    $row->numero_semestre,
                    $row->ano_inicio,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }
    
        
    public function exportEstudantesNaoAtivo(Request $request)
    {
        $id_departamento = $request->input('id_departamento');
        $ano_inicio = $request->input('ano_inicio');
    
        // Query filtered data
        $data = DB::table('view_estudante')
            ->where('id_departamento', $id_departamento)
            ->when($ano_inicio, function ($query, $ano_inicio) {
                return $query->where('ano_inicio', $ano_inicio);
            })
            ->get();
    
        // Prepare CSV
        $filename = "estudantes_{$id_departamento}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
    
        $columns = ['NRE','Nome', 'Sexo', 'Data Moris', 'Departamento',' Programa Estudo', 'Semestre', 'Ano Academico'];
    
        $callback = function () use ($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Header row
    
            foreach ($data as $row) {
                fputcsv($file, [
                    $row->nre,
                    $row->nome_estudante,
                    $row->sexo,
                    $row->data_moris,
                    $row->nome_departamento,
                    $row->nome_programa,
                    $row->numero_semestre,
                    $row->ano_inicio,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }


   
    public function create()
    {
        $municipios = ViewMunicipioPosto::select('id_municipio', 'municipio')
         ->distinct()
         ->get();
        $semestre = ModelSemestre::all();
      
        $programaEstudo = ModelProgramaEstudo::all(); // Ajustei o nome da variável
        return view('pages.students.admission_form_student', compact('semestre', 'programaEstudo','municipios'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'nre' => 'required|string|max:50|unique:students,nre', // Add unique validation here
            'faculty' => 'required|string|max:255',
            'id_programa_estudo' => 'required|string',
            'id_semestre' => 'required|string',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'),
            'ano_semestre' => 'nullable|string|max:255',
            'id_aldeias' => 'nullable|string|max:255',
            'id_suco' => 'nullable|string|max:255',
            'id_posto_administrativo' => 'nullable|string|max:255',
            'id_municipio' => 'nullable|string|max:255',
            'nacionalidade' => 'nullable|string|max:255',
            'endereco_atual' => 'nullable|string|max:255',
        ]);
    
        // Check if nre already exists in the database
        $existingStudent = ModelStudent::where('nre', $validatedData['nre'])->first();
        if ($existingStudent) {
            return redirect()->back()->withErrors(['nre' => 'O número NRE já está em uso.'])->withInput();
        }
    
        // Handle file upload
        if ($request->hasFile('student_image')) {
            $image = $request->file('student_image');
            $student_image = $image->hashName();
            $image->storeAs('public/asset/posts', $student_image);
            $validatedData['student_image'] = $student_image;
        }
    
        // Set nullable fields to null if not provided
        $nullableFields = ['id_posto_administrativo', 'id_municipio', 'id_suco', 'id_aldeias', 'nacionalidade', 'endereco_atual'];
        foreach ($nullableFields as $field) {
            $validatedData[$field] = $validatedData[$field] ?? null;
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
        ]);
    
        // Create associated user
        ModelUser::create([
            'user_id' => (string) Str::uuid(),
            'username' => $student->nre,
            'email' => null,
            'password' => Hash::make('defaultpassword'),
            'docente_id_student' => $student->id_student,
            'tipo_usuario' => 'Estudante',
        ]);
    
        // Create associated matricula and semestre estudante
        ModelMatricula::create([
            'id_matricula' => (string) Str::uuid(),
            'id_student' => $student->id_student,
            'id_programa_estudo' => $validatedData['id_programa_estudo'],
            'id_semestre' => $validatedData['id_semestre'],
        ]);
    
        ModelsemestreEstudante::create([
            'id_semestre_estudante' => (string) Str::uuid(),
            'id_student' => $student->id_student,
            'id_semestre' => $validatedData['id_semestre'],
            'ano_semestre' => $validatedData['ano_semestre'],
        ]);
    
        // Create naturalidade estudante if applicable
        if ($validatedData['id_municipio'] || $validatedData['id_posto_administrativo'] || $validatedData['id_suco'] || $validatedData['id_aldeias'] || $validatedData['nacionalidade'] || $validatedData['endereco_atual']) {
            ModelNaturalidadeEstudante::create([
                'id_naturalidade_estudante' => (string) Str::uuid(),
                'id_student' => $student->id_student,
                'id_municipio' => $validatedData['id_municipio'],
                'id_posto_administrativo' => $validatedData['id_posto_administrativo'],
                'id_suco' => $validatedData['id_suco'],
                'id_aldeias' => $validatedData['id_aldeias'],
                'nacionalidade' => $validatedData['nacionalidade'] ?? 'Desconhecida',
                'endereco_atual' => $validatedData['endereco_atual'] ?? '',
            ]);
        }
    
        return redirect()->route('students.index')->with('success', 'Dados do estudante gravados com sucesso!');
    }
    
   


    public function edit($id_student)
    {
        // Carregar o estudante com dados relacionados
        $student = ModelStudent::with(['matriculas.semestre', 'matriculas.programaEstudo.departamento'])->findOrFail($id_student);

        // Obter todos os departamentos e semestres disponíveis
        $modelDepartamentos = ModelDepartamento::all();
        $semesters = ModelSemestre::all();

        // Passar o estudante, departamentos e semestres para a view
        return view('pages.students.student_edit', compact('student', 'modelDepartamentos', 'semesters'));
    }


    public function detail_estudent($id_student)
    {
        $student = ModelStudent::with(['matriculas.semestre', 'matriculas.programaEstudo.departamento'])->findOrFail($id_student);
        $detail = DB::table('view_estudante')
        ->where('id_student', $id_student)
        ->first();
      
        return view('pages.students.student_details', compact('detail', 'student'));
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

    // public function destroys(ModelStudent $student)
    // {
    //     if ($student->student_image) {
    //         Storage::delete('public/asset/posts/' . $student->student_image);
    //     }

    //     $student->delete();

    //     return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    // }

    public function destroy($id)
    {
        // Find the docente by its ID
        $student = ModelStudent::findOrFail($id);
   
        // Update the `controlo_estado` field to 'deleted'
        $student->controlo_estado = 'Nao Ativo';
        $student->save();
   
        // Redirect back with success message
        return redirect()->route('students.index')->with('success', 'Estudante Desabilitar Com Sucesso');
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
    // public function MateriaEstudante($id)
    // {
    //     $student = ModelStudent::with(['matriculas.semestre', 'matriculas.programaEstudo.departamento'])->findOrFail($id);

    //     $detailho_docente_semestre_estudante = DB::table('view_curiculo')
    //     ->where('id_student', $id)
    //     ->orderBy('numero_semestre', 'asc')
    //     ->get();
      
    //     return view('pages.students.estudante_materia.materia_estudante', compact('student','detailho_docente_semestre_estudante'));
    // }


    public function MateriaEstudante($id)
    {
        // Fetch curriculum details grouped by semester
        $details = DB::table('view_curiculo')
            ->select('codigo_materia', 'materia', 'numero_semestre', 'credito')
            ->where('id_student', $id)
            ->orderBy('numero_semestre')
            ->get();
    
        // Fetch student details with related matriculas, semestre, and departamento
        $student = ModelStudent::with(['matriculas.semestre', 'matriculas.programaEstudo.departamento'])->findOrFail($id);
    
        // Group curriculum data by semester
        $groupedBySemester = $details->groupBy('numero_semestre');
    
        // Pass both curriculum data and student data to the view
        return view('pages.students.estudante_materia.materia_estudante', [
            'groupedBySemester' => $groupedBySemester,
            'student' => $student,
        ]);
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
            ->orderByDesc('id_controlo_departamento')
            ->paginate(10);
            return view('pages.students.estudante_pagamento.pagamento',compact('student','pagamento'));
        }

        public function create_pagamento($id)
        {
            // Retrieve departamento data with left join and where clause
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
        
            // Retrieve student details
            $student = ModelStudent::findOrFail($id);
        
            // Retrieve semestre data
            $semestre = ModelSemestre::all();
        
           
            // Pass data to the view
            return view('pages.students.estudante_pagamento.form_create_pagamento', compact('student', 'id', 'departamento', 'semestre'));
        }


        // public function Pagamentostore(Request $request)
        // {

        //     $request->validate([
        //         'id_controlo_departamento' => 'required|string|max:255',
                
        //     ]);
    
        //     $pagamento = new ModelPagamentoStudante();
        //     $pagamento->id_student = $request->input('id_student');
        //     $pagamento->id_semestre = $request->input('id_semestre');
        //     $pagamento->id_controlo_departamento = $request->input('id_controlo_departamento');
        //     $pagamento->data_selu = $request->input('data_selu');
        //     $pagamento->tipo_selu = $request->input('tipo_selu');
        //     $pagamento->selu_total = $request->input('selu_total');
        //     $pagamento->falta = $request->input('falta');
        //     $pagamento->observacao = $request->input('observacao');
        //     $pagamento->save();
    
        //     return redirect()->route('pagamento_estudante', ['id' => $request->input('id_student')])
        //         ->with('success', 'Pagamento Estudamte inserida com sucesso.');
        // }


        public function Pagamentostore(Request $request)
        {
            
            $request->validate([
                'id_controlo_departamento' => 'required|string|max:255',
                // ... outras validações
            ]);

            $pagamento = new ModelPagamentoStudante();
            $pagamento->id_student = $request->input('id_student');
            $pagamento->id_semestre = $request->input('id_semestre');
            $pagamento->id_controlo_departamento = $request->input('id_controlo_departamento');
            $pagamento->data_selu = $request->input('data_selu');
            $pagamento->tipo_selu = $request->input('tipo_selu');
            $pagamento->selu_total = $request->input('selu_total');
            $pagamento->observacao = $request->input('observacao');
            // ... outros atributos

            // Calcular o valor faltante
            $totalIndice = $request->input('total_indice');
            $seluTotal = $request->input('selu_total');
            $falta = $totalIndice - $seluTotal;
        
            // Menggunakan mass assignment
            $pagamento->fill([
                'total_indice' => $totalIndice,
                'selu_total' => $seluTotal,
                'falta' => $falta,
                // ... atribut lainnya
            ]);

            $pagamento->save();

            return redirect()->route('pagamento_estudante', ['id' => $request->input('id_student')])
                ->with('success', 'Pagamento Estudante inserida com sucesso!');
        }



      
    public function listaPagamento()
    {
    
        $departments = DB::table('view_monitoramento_pagamento_estudante')
        ->select('nome_departamento')
        ->distinct()
        ->orderBy('nome_departamento', 'asc')
        ->get();
        return view('pages.students.monitora_pagamento_estudante.lista_pagamento_estudante', compact('departments'));
    }

    // public function getPaymentStudent(Request $request)
    // {
    //     if ($request->ajax()) {
        
    //         // Use DB query without pagination as DataTables will handle pagination
    //         $data = DB::table('view_monitoramento_pagamento_estudante')->select('*');
            
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $editUrl = route('pagamento_estudante', $row->id_student);
                   
    //                 // Create Edit button
    //                 $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Detailho</a>';
                    
    //                 // Append Detail button
                   
    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }
    public function getPaymentStudent(Request $request)
    {
        if ($request->ajax()) {
            $query = DB::table('view_monitoramento_pagamento_estudante')->select('*');
            
            // Apply search filters if provided
            if ($request->searchID) {
                $query->where('nre', 'like', "%{$request->searchID}%");
            }
            
            if ($request->searchName) {
                $query->where('complete_name', 'like', "%{$request->searchName}%");
            }
            
            if ($request->filterDepartment) {
                $query->where('nome_departamento', $request->filterDepartment);
            }
    
            if ($request->filterYear) {
                $query->whereYear('data_selu', $request->filterYear);
            }
    
            if ($request->filterMonth) {
                $query->whereMonth('data_selu', $request->filterMonth);
            }
    
            if ($request->filterPaymentStatus) {
                $query->where('payment_status', $request->filterPaymentStatus);
            }
    
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $editUrl = route('pagamento_estudante', $row->id_student);
                    return '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Detalho Data</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function exportPayments(Request $request)
    {
        $filters = [
            'department' => $request->get('filterDepartment'),
            'year' => $request->get('filterYear'),
            'month' => $request->get('filterMonth'),
            'payment_status' => $request->get('filterPaymentStatus'),
        ];
    
        return Excel::download(new PaymentsExport($filters), 'payments.xlsx');
    }

            public function exportPaymentsCSV(Request $request)
        {
            $filters = [
                'department' => $request->get('filterDepartment'),
                'year' => $request->get('filterYear'),
                'month' => $request->get('filterMonth'),
                'payment_status' => $request->get('filterPaymentStatus'),
            ];

            // Export to CSV instead of Excel
            return Excel::download(new PaymentsExport($filters), 'payments.csv', \Maatwebsite\Excel\Excel::CSV);
        }

        // estudante cuti
        public function EstudanteLicenca( $id)
        {
        
            $student = ModelStudent::findOrFail($id);
            
            $licensa = DB::table('view_licensa_estudante')
            ->where('id_student', $id)
            ->paginate(5);

            
           
            return view('pages.students.estudante_licenca.estudante_licenca',compact('student','licensa') );
        }



        public function TipoPagamentoIndice()
        {

            $departamento = ModelDepartamento::all();
            return view('pages.students.monitora_pagamento_estudante.tipo_pagamento_indice', compact('departamento'));
        }

        public function getTipoIndice(Request $request)
        {
            if ($request->ajax()) {
                // Obtendo dados da tabela ou view correta
                $data = DB::table('view_tipo_pagamento')
                    ->select('id_controlo_departamento', 'nome_departamento', 'ano_academico', 'total_indice'); // Ajuste conforme os campos disponíveis
        
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        // Construção dos botões de ação
                        $editUrl = route('materia.edit', $row->id_controlo_departamento);
        
                        $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Edit</a>';
                        $btn .= ' <form action="' . route('materia.destroy', $row->id_controlo_departamento) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza de apagar este dado?\')">Delete</button>
                                </form>';
        
                        return $btn;
                    })
                    ->rawColumns(['action']) // Necessário para permitir HTML nos botões
                    ->make(true);
            }
        }
        

    // formulario licensa
        public function InserirLicenca( $id)
        {
        
            $student = ModelStudent::findOrFail($id);
            $tipo_licensa = DB::table('tipo_licensa')
            ->paginate(5);
            return view('pages.students.estudante_licenca.inserir_estudante_licensa',compact('student','id','tipo_licensa') );
        }

        public function LicensaStore(Request $request)
        {
            $request->validate([
             'id_student' => 'required|string|max:255',
             'id_tipo_licensa' => 'required|string|max:255',
             'data_inicio_licensa' => 'required|string|max:255',
             'data_fim_licensa' => 'required|string|max:255',
            
            ]);
    
            $licensa = new ModelLicencaEstudante();
            $licensa->id_student = $request->input('id_student');
            $licensa->id_tipo_licensa = $request->input('id_tipo_licensa');
            $licensa->data_inicio_licensa = $request->input('data_inicio_licensa');
            $licensa->data_fim_licensa = $request->input('data_fim_licensa');
            $licensa->observacao = $request->input('observacao');
          
            $licensa->save();
    
            return redirect()->route('estudante_licenca', ['id' => $request->input('id_student')])
                ->with('success', 'Licensa registrado com sucesso.');
        }
    

        public function LicensaAlterar( $id)
        {
        
            $licensa = ModelLicencaEstudante::findOrFail($id);
            // $student = ModelStudent::findOrFail($id);
            $tipo_licensa = DB::table('tipo_licensa')
            ->paginate(5);
            $student = DB::table('view_licensa_estudante')
            ->where('id_licensa_estudante', $id)
            ->first();

          
      

            return view('pages.students.estudante_licenca.alterar_licensa_estudante',compact('student','licensa','id','tipo_licensa') );
        }


        // Start semestre estudante 

        public function SemestreEstudante( $id)
        {
        
            $student = ModelStudent::findOrFail($id);        
                
                $semestreEstudantes = DB::table('view_semestre_estudante')
                ->where('id_student', $id)
                ->paginate(5);
                  
                $finalista = DB::table('view_finalista_estudante')
                ->where('id_student', $id)
                ->paginate(5);
           
            return view('pages.students.semestre_estudante.semestre',compact('student','semestreEstudantes','finalista') );
        }


        public function InserirSemestre( $id)
        {    
            $student = ModelStudent::findOrFail($id);
            $tipo_semestre = DB::table('semestre')
            ->paginate(5);
            return view('pages.students.semestre_estudante.inserir_semestre',compact('student','id','tipo_semestre') );
        }

        public function SemestreStore(Request $request)
        {
            $request->validate([
             'id_student' => 'required|string|max:255',
             'id_semestre' => 'required|string|max:255',
             'ano_semestre' => 'required|string|max:255',
             'data_atualiza_semestre' => 'required|string|max:255',
            
            ]);
    
            $semestre = new ModelsemestreEstudante();
            $semestre->id_student = $request->input('id_student');
            $semestre->id_semestre = $request->input('id_semestre');
            $semestre->ano_semestre = $request->input('ano_semestre');
            $semestre->data_atualiza_semestre = $request->input('data_atualiza_semestre');
            $semestre->observacao = $request->input('observacao');
          
            $semestre->save();
    
            return redirect()->route('semestre_estudante', ['id' => $request->input('id_student')])
                ->with('success', 'Dados Semestre de estudante foi registrado com sucesso.');
        }


        public function SemestreAlterar( $id)
        {
        
        
            $semestre = ModelsemestreEstudante::all();
            // $student = ModelStudent::findOrFail($id);
            $tipo_semestre = DB::table('semestre')
            ->paginate(5);
            $student = DB::table('view_estudante_cada_materia')
            ->where('id_semestre_estudante', $id)
            ->first();

            $editar = DB::table('view_semestre_estudante')
            ->where('id_semestre_estudante', $id)
            ->first();
          

            return view('pages.students.semestre_estudante.alterar_semestre',compact('student','semestre','id','tipo_semestre','editar') );
        }

        public function updateSemestreEstudante(Request $request, $id)
        {
            $request->validate([
              'id_student' => 'required|string|max:255',
             'id_semestre' => 'required|string|max:255',
             'ano_semestre' => 'required|string|max:255',
           
            ]);
    
            $semestreestudantes = ModelsemestreEstudante::findOrFail($id); // Find the habilitacao to update
            $semestreestudantes->id_student = $request->input('id_student');
            $semestreestudantes->id_semestre = $request->input('id_semestre');
            $semestreestudantes->ano_semestre = $request->input('ano_semestre');
            $semestreestudantes->data_atualiza_semestre = $request->input('data_atualiza_semestre');
            $semestreestudantes->save(); // Save the updated habilitacao
    
            // Redirect back to the habilitacao page with a success message
            return redirect()->route('semestre_estudante', ['id' => $request->input('id_student')])
            ->with('success', 'Dados Semestre de estudante foi atualizado com sucesso.');
        }
     
        public function destroySemestre($id)
        {
            try {
                ModelsemestreEstudante::findOrFail($id)->delete();
                return redirect()->back()->with('success', 'Semestre Estudante excluído com sucesso!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Erro ao excluir finalista.');
            }
        }

        //start finalista
        public function CreateFinalista( $id)
        {    
            $student = ModelStudent::findOrFail($id);
           
            return view('pages.students.estudante_finalista.inserir_finalista',compact('student','id') );
        }

        public function storeFinalista(Request $request)
        {
            $request->validate([
                'id_student' => 'required|string|max:255',
                'ano_academico' => 'required|string|max:255',
                'estatus' => 'required|string|max:255',
            ]);
        
            try {
                $finalista = new ModelFinalista();
                $finalista->id_student = $request->input('id_student');
                $finalista->ano_academico = $request->input('ano_academico');
                $finalista->estatus = $request->input('estatus');
                $finalista->observacao = $request->input('observacao');
                
                $finalista->save();
        
                return redirect()->route('semestre_estudante', ['id' => $request->input('id_student')])
                    ->with('success1', 'Dados Finalista foi registrado com sucesso.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error1', 'Falha ao registrar os dados do Finalista. Por favor, tente novamente.');
            }
        }
        
        public function destroyFinalista($id)
        {
            try {
                ModelFinalista::findOrFail($id)->delete();
                return redirect()->back()->with('success2', 'Finalista excluído com sucesso!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Erro ao excluir finalista.');
            }
        }

        #remata


        // naturalidade
        public function create_naturalidade_estudante($id)
        {
          
            $student = ModelStudent::findOrFail($id);
                
    
             $municipios = ViewMunicipioPosto::select('id_municipio', 'municipio')
             ->distinct()
             ->get();
            return view('pages.students.naturalidade_estudante.naturalidade_estudante_inserir', compact( 'id', 'student','municipios'));
        }


        public function storeNaturalidadeEstudante(Request $request)
        {
            $request->validate([
             'id_aldeias' => 'required|string|max:255',
             'id_suco' => 'required|string|max:255',
             'id_posto_administrativo' => 'required|string|max:255',
             'id_municipio' => 'required|string|max:255',
            ]);
    
            $naturalidade = new ModelNaturalidadeEstudante();
            $naturalidade->id_student = $request->input('id_student');
            $naturalidade->id_municipio = $request->input('id_municipio');
            $naturalidade->id_posto_administrativo = $request->input('id_posto_administrativo');
            $naturalidade->id_suco = $request->input('id_suco');
            $naturalidade->id_aldeias = $request->input('id_aldeias');
            $naturalidade->nacionalidade = $request->input('nacionalidade');
            $naturalidade->endereco_atual = $request->input('endereco_atual');
            $naturalidade->observacao = $request->input('observacao');
            $naturalidade->save();
    
            return redirect()->route('students.detail', ['id' => $request->input('id_student')])
                ->with('success', 'Naturalidade inserida com sucesso.');
        }


        public function editNaturalidadeEstudante($id)
        {
            // Fetch the habilitacao by its ID
            $edit = ModelNaturalidadeEstudante::findOrFail($id);
    
            $detail = DB::table('view_estudante')
            ->where('id_student', $id)
            // ->orderByDesc('created_at')
            ->first();
    
            $municipios = ViewMunicipioPosto::select('id_municipio', 'municipio')
            ->distinct()
            ->get();
            return view('pages.students.naturalidade_estudante.naturalidade_alterar', compact('id','detail','edit','municipios'));
        }
}
