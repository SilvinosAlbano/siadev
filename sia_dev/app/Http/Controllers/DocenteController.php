<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\ModelDocente;
use App\Models\ModelPozisaunFuncionario;
use App\Models\ViewMunicipioPosto;
use App\Models\ViewPostoSuco;
use App\Models\ViewSucoAldeia;
use App\Models\ModelUser;
use App\Models\ModelDepartamento;
use App\Models\ModelEstatuto;
use App\Models\HabilitacaoModel;
use App\Models\FuncionarioEstatutoModel;
use App\Models\ModelFuncionarioDepartamento;
use App\Models\ModelNaturalidadeFuncionario;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DocentesExport;
use App\Models\ModelDocenteDaMateria;
use Database\Seeders\FuncionarioEstatuto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\ModelGdivisaoAdministrativaPostoAdministrativo; //Asesu ba View Divisao Administrativa nian
use App\Models\ModelGdivisaoAdministrativaSucosAldeias; ////Asesu ba View Divisao Administrativa nian
use App\Models\ModelHorario;
use App\Models\ModelMateria;
use App\Models\ViewDocenteMateriaEstudante;
use TCPDF;
Use App\Http\Controllers\Storage;
use App\Http\Controllers\rawcolumns;
use App\Imports\TeacherImport;
use App\Models\ModelMateriaSemestre;
use App\Models\ModelSemestre;
use App\Models\ModelvalorEstudante;

// Atu View karik bele bolu hanesan ne
#$postoAdministrativoData = ModelGdivisaoAdministrativaPostoAdministrativo::all();
#$sucosAldeiasData = ModelGdivisaoAdministrativaSucosAldeias::all();


class DocenteController extends Controller
{



    public function escolhaDados()
    {
     
        $departamento = DB::table('funcionario as a')
        ->select(
            'h.id_departamento',
            'h.nome_departamento',
            DB::raw('COUNT(a.id_funcionario) as total_funcionarios')
        )
        ->leftJoin('departamento_funcionario as g', 'g.id_funcionario', '=', 'a.id_funcionario')
        ->leftJoin('departamento as h', 'h.id_departamento', '=', 'g.id_departamento')
        ->whereNotNull('h.id_departamento') // Exclude records where id_departamento is null
        ->groupBy('h.id_departamento', 'h.nome_departamento')
        ->get();
    
    $alerta_tipo_contrato = DB::table('funcionario as a')
        ->select(
            'j.estatuto as tipo_contrato', 
            DB::raw('COUNT(DISTINCT a.id_funcionario) as total_funcionarios')
        )
        ->leftJoin('estatuto_funcionario as i', 'i.id_funcionario', '=', 'a.id_funcionario')
        ->leftJoin('tipo_estatuto as j', 'j.id_estatuto', '=', 'i.id_estatuto')
        ->whereNotNull('j.estatuto') // Exclude records where estatuto is null
        ->groupBy('j.estatuto')
        ->get();
    
        return view('pages.teachers.escolha_modul_docente', compact('departamento','alerta_tipo_contrato'));

    }

    public function showDetailEscolha($id)
    {
        // Fetch the detail data from the view_gfuncionario view based on id_funcionario
        $docente = DB::table('view_docente')
            ->where('id_departamento', $id)
            ->orderByDesc('created_at')
            ->first();

           
        // Check if the data was found
        if (!$docente) {
            // Optionally, handle the case where no data was found
            return redirect()->back()->with('error', 'Details not found.');
        }

        return view('pages.teachers.docente_por_departamento', compact('docente'));
    }

    // index dados gerais docentes
    public function index(Request $request)
    {
     
        
        return view('pages.teachers.all_teachers');
        

    }


    public function getDocentesdepartamento(Request $request)
    {
        $id_departamento = $request->id_departamento;
    
        if ($request->ajax()) {
            $data = DB::table('view_docente')
                      ->where('id_departamento', $id_departamento) // Filter by id_departamento
                      ->select('*');
    
                      return DataTables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row) {
                          $editUrl = route('editar', $row->id_funcionario);
                          $detailUrl = route('detailho', $row->id_funcionario);
                          $deleteUrl = route('docentes.destroy', $row->id_funcionario);
                  
                          $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Edit</a>';
                          $btn .= ' <a href="' . $detailUrl . '" class="detail btn btn-info btn-sm">Detail</a>';
                          $btn .= ' <button type="button" class="delete btn btn-danger btn-sm" onclick="confirmDelete(\'' . $deleteUrl . '\')">Delete</button>';
                  
                          return $btn;
                      })
                      ->rawColumns(['action']) // Ensure correct syntax here
                      ->make(true);
                  
        }
    }
    




    public function getFuncionario(Request $request)
    {
        if ($request->ajax()) {
        
            // Use DB query without pagination as DataTables will handle pagination
            $data = DB::table('view_docente')->select('*');
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('editar', $row->id_funcionario);
                    $detailUrl = route('detailho', $row->id_funcionario);
                    $deleteUrl = route('docentes.destroy', $row->id_funcionario); // Delete route
                    // Create Edit button
                    $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    
                    // Append Detail button
                    $btn .= ' <a href="' . $detailUrl . '" class="detail btn btn-info btn-sm">Detail</a>';
                    
                    // Append Delete form
                    // $btn .= ' <form action="' . route('docentes.destroy', $row->id_funcionario) . '" method="POST" style="display:inline;">
                    //             ' . csrf_field() . '
                    //             ' . method_field('DELETE') . '
                    //             <button type="submit" class="delete btn btn-danger btn-sm" onclick="confirmDelete(\'' . $deleteUrl . '\')">Delete</button>
                    //         </form>';

                    $btn .= ' <button type="button" class="delete btn btn-danger btn-sm" onclick="confirmDelete(\'' . $deleteUrl . '\')">Delete</button>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

 # Start Funcionario adicionar
 public function formDocente()
 {
    
     $materia = ModelMateria::all();
     $fac = DB::table('faculdade')->paginate(10); 
     $departament = DB::table('departamento')->paginate(10);      
     $estatuto = ModelEstatuto::all();
     $dep = HabilitacaoModel::all();
     $tipo_admin = (new ModelDocente())->getAllData();
     $departamento = ModelDepartamento::all(); // Assuming you have a Docente model
     $estatuto = ModelEstatuto::all();
     $docente = ModelDocente::paginate(10);
     $municipios = ViewMunicipioPosto::select('id_municipio', 'municipio')
         ->distinct()
         ->get();
     return view('pages.teachers.add_teacher', compact('docente', 'departamento', 'estatuto', 'tipo_admin', 'municipios','fac','departament','materia'));
 }

 function removeAccents($string) {
    return iconv('UTF-8', 'ASCII//TRANSLIT', $string);
}
 public function store(Request $request): RedirectResponse
 {
     // Validation Rules
     $validatedData = $request->validate([
         'nome_funcionario' => 'required|string|max:255',
         'sexo' => 'required|string|max:255',
         'data_moris' => 'required|date',
         'id_funcionario' => 'nullable|string|max:255',
         'id_aldeias' => 'nullable|string|max:255',
         'id_suco' => 'nullable|string|max:255',
         'id_posto_administrativo' => 'nullable|string|max:255',
         'id_municipio' => 'nullable|string|max:255',
         'nacionalidade' => 'nullable|string|max:255',
         'endereco_atual' => 'nullable|string|max:255',
         'id_tipo_categoria' => 'nullable|string|max:255', // Nullable
         'ano_inicio' => 'nullable|date',
         'observacao' => 'nullable|string',
         'categoria' => 'required|string|max:255',
         'titulu' => 'nullable|string|max:255',
         'no_contacto' => 'nullable|string|max:255',
         'email' => 'nullable|email|max:255',
         'id_faculdade' => 'required|string|max:255',
         'id_departamento' => 'required|string|max:255',
         'habilitacao' => 'required|string|max:255',
         'area_especialidade' => 'required|string|max:255',
         'universidade_origem' => 'required|string|max:255',
         'id_estatuto' => 'required|string|max:255',
         'data_inicio' => 'required|date',
         'data_fim' => 'nullable|date', // Nullable end date
     ]);
 
     // Handle File Upload if an image is provided
     $photo_docente = null; // Default value if no image is uploaded
     if ($request->hasFile('photo_docente')) {
         $image = $request->file('photo_docente');
         $photo_docente = $image->hashName(); // Generate a unique name for the image
         $image->storeAs('public/asset/posts', $photo_docente); // Store the image
     }
 
     // Explicitly check if 'id_tipo_categoria' exists in the request
     $id_tipo_categoria = $request->has('id_tipo_categoria') ? $validatedData['id_tipo_categoria'] : null;
 
     // Create a new record in the 'funcionarios' table
     $funcionarios = ModelDocente::create([
         'id_funcionario' => (string) Str::uuid(),
         'photo_docente' => $photo_docente, // Use the photo name if available, otherwise null
         'nome_funcionario' => $validatedData['nome_funcionario'],
         'sexo' => $validatedData['sexo'],
         'data_moris' => $validatedData['data_moris'],
         'id_tipo_categoria' => $id_tipo_categoria,
         'ano_inicio' => $validatedData['ano_inicio'],
         'observacao' => $validatedData['observacao'],
         'no_contacto' => $validatedData['no_contacto'],
         'email' => $validatedData['email'],
         'categoria' => $validatedData['categoria'],
         'titulu' => $validatedData['titulu']
     ]);
 
     // Create associated user record
      // Extract first and last name from nome_funcionario
    //   $nameParts = explode(' ', $funcionarios->nome_funcionario);
    //   $firstName = $nameParts[0] ?? '';
    //   $lastName = $nameParts[count($nameParts) - 1] ?? '';
    // //   $middleName = implode(' ', array_slice($nameParts, 1, -1));
    //   $username = strtolower($firstName. '.' .$lastName);

      // Create ModelUser record
      function removeAccents($string) {
        $unwanted = array(
            'Á'=>'A', 'À'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'AE', 'Ç'=>'C',
            'É'=>'E', 'È'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Í'=>'I', 'Ì'=>'I', 'Î'=>'I', 'Ï'=>'I',
            'Ñ'=>'N', 'Ó'=>'O', 'Ò'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ú'=>'U',
            'Ù'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'á'=>'a', 'à'=>'a', 'â'=>'a', 'ã'=>'a',
            'ä'=>'a', 'å'=>'a', 'æ'=>'ae', 'ç'=>'c', 'é'=>'e', 'è'=>'e', 'ê'=>'e', 'ë'=>'e',
            'í'=>'i', 'ì'=>'i', 'î'=>'i', 'ï'=>'i', 'ñ'=>'n', 'ó'=>'o', 'ò'=>'o', 'ô'=>'o',
            'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ú'=>'u', 'ù'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '~'=>'', "'"=>''
        );
        return strtr($string, $unwanted);
    }
    
    // Remove accents from first and last names
    $nameParts = explode(' ', $funcionarios->nome_funcionario);
    $firstName = removeAccents($nameParts[0] ?? '');
    $lastName = removeAccents($nameParts[count($nameParts) - 1] ?? '');
    
    // Generate username without accents
    $username = strtolower($firstName . '.' . $lastName);
    //   $password = Str::random(10);
      ModelUser::create([
          'user_id'            => (string) Str::uuid(),
          'username'           => $username,
          'email'              => $funcionarios->email,
          'password'           => Hash::make('123456'),
        //  'password'           => Hash::make($password),
          'docente_id_student' => $funcionarios->id_funcionario,
          'tipo_usuario'       => 'Docente',
      ]);
    //  ModelUser::create([
    //      'user_id' => (string) Str::uuid(),
    //      'username' => $funcionarios->nome_funcionario, // Assuming 'nre' refers to 'nome_funcionario'
    //      'email' => $request->email ?? null,
    //      'password' => Hash::make('defaultpassword'), // Default password, replace with logic to generate a secure password
    //      'docente_student_id' => $funcionarios->id_funcionario,
    //      'tipo_usuario' => $funcionarios->categoria,
    //  ]);
 
     // Create a new entry in the 'funcionario_departamento' table
     ModelFuncionarioDepartamento::create([
         'id_departamento_funcionario' => (string) Str::uuid(),
         'id_funcionario' => $funcionarios->id_funcionario,
         'id_faculdade' => $validatedData['id_faculdade'],
         'id_departamento' => $validatedData['id_departamento'],
         'data_inicio' => $validatedData['data_inicio'],
         'data_fim' => $validatedData['data_fim'],
     ]);
 
     // Create a new entry in the 'habilitacao' table
     HabilitacaoModel::create([
         'id_habilitacao' => (string) Str::uuid(),
         'id_funcionario' => $funcionarios->id_funcionario,
         'habilitacao' => $validatedData['habilitacao'],
         'area_especialidade' => $validatedData['area_especialidade'],
         'universidade_origem' => $validatedData['universidade_origem'],
     ]);
 
     // Create a new entry in the 'estatuto' table
     FuncionarioEstatutoModel::create([
         'id_estatuto_funcionario' => (string) Str::uuid(),
         'id_funcionario' => $funcionarios->id_funcionario,
         'id_estatuto' => $validatedData['id_estatuto'],
         'data_inicio' => $validatedData['data_inicio'],
         'data_fim' => $validatedData['data_fim'],
     ]);


     ModelNaturalidadeFuncionario::create([
        'id_naturalidade_funcionario' => (string) Str::uuid(),
        'id_funcionario' => $funcionarios->id_funcionario,
        'id_municipio' => $validatedData['id_municipio'],
        'id_posto_administrativo' => $validatedData['id_posto_administrativo'],
        'id_suco' => $validatedData['id_suco'],
        'id_aldeias' => $validatedData['id_aldeias'],
        'nacionalidade' => $validatedData['nacionalidade'],
        'endereco_atual' => $validatedData['endereco_atual'],
        'observacao' => $validatedData['observacao'],
    ]);
 
     // Redirect with success or error message
     if ($funcionarios) {
         return redirect()->route('adiciona_funcionario.index')->with(['success' => 'Parabens Dados com sucesso gravados!']);
     } else {
         return back()->withInput()->withErrors(['error' => 'Failed to save data.']);
     }
 }
 
 
 




 // editar docente
 public function edit($id)
 {
     $departamento = ModelDepartamento::all(); // Assuming you have a Docente model
     $estatuto = ModelEstatuto::all();
     $editar = ModelDocente::findOrFail($id);
     // $funcionario = DB::table('view_gfuncionario')
     // ->whereIn('id', $id) // Assuming 'id' is the column name for filtering
     // ->get();

     $municipios = ViewMunicipioPosto::select('id_municipio', 'municipio')
     ->distinct()
     ->get();
     $postos = ViewPostoSuco::select('id_posto_administrativo', 'posto_administrativo')
     ->distinct()
     ->get();

     $sucos = ViewSucoAldeia::select('id_sucos', 'sucos')
     ->distinct()
     ->get();

     $aldeias = ViewSucoAldeia::select('id_sucos', 'sucos')
     ->distinct()
     ->get();
     $tipo_admin = (new ModelDocente())->getAllData();

     return view('pages.teachers.edit_teacher', compact('tipo_admin','aldeias','sucos','postos','municipios','editar', 'departamento', 'estatuto'));
 }

 public function update(Request $request, $id): RedirectResponse
 {
     // Find the existing docente record
     $funcionarios = ModelDocente::findOrFail($id);

     // Validation Rules
     $validated = $request->validate([
         'nome_funcionario' => 'required|string|max:255',
         'sexo' => 'required|string|max:255',
         'data_moris' => 'required|date',
         'id_aldeias' => 'required|string|max:255',
         'id_sucos' => 'required|string|max:255',
         'id_posto_administrativo' => 'required|string|max:255',
         'id_municipio' => 'required|string|max:255',
         'nacionalidade' => 'nullable|string|max:255',            
         'ano_inicio' => 'nullable|date',
         'observacao' => 'nullable|string',
         'titulu' => 'nullable|string',
     ]);

     // Handle File Upload if a new image is provided
     if ($request->hasFile('photo_docente')) {
         // Delete the old image if it exists
         if ($funcionarios->photo_docente) {
             Storage::delete('public/asset/posts/' . $funcionarios->photo_docente);
         }

         // Store the new image
         $image = $request->file('photo_docente');
         $photo_docente = $image->hashName(); // Generate a unique name for the image
         $image->storeAs('public/asset/posts', $photo_docente);
     } else {
         // If no new image, keep the current one
         $photo_docente = $funcionarios->photo_docente;
     }

     // Update the existing record in the database
     $funcionarios->update([
         'photo_docente' => $photo_docente, // Use the new photo name if available, otherwise retain the old one
         'nome_funcionario' => $validated['nome_funcionario'],
         'sexo' => $validated['sexo'],
         'data_moris' => $validated['data_moris'],
         'id_aldeias' => $validated['id_aldeias'],
         'id_sucos' => $validated['id_sucos'],
         'id_posto_administrativo' => $validated['id_posto_administrativo'],
         'id_municipio' => $validated['id_municipio'],
         'nacionalidade' => $validated['nacionalidade'],           
         'ano_inicio' => $validated['ano_inicio'],
         'observacao' => $validated['observacao'],
         'titulu' => $validated['titulu']
     ]);

     // Redirect with Success Message
     return redirect()->route('funcionarios.index')->with(['success' => 'Dados Funcionario atualizados com sucesso']);
 }



 public function destroy($id)
 {
     // Find the docente by its ID
     $docente = ModelDocente::findOrFail($id);

     // Update the `controlo_estado` field to 'deleted'
     $docente->controlo_estado = 'Nao Ativo';
     $docente->save();

     // Redirect back with success message
     return redirect()->route('funcionarios.index')->with('success', 'Docente status  deleted successfully');
 }

    public function showDetail($id)
    {
        // Fetch the detail data from the view_gfuncionario view based on id_funcionario
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();

           
        // Check if the data was found
        if (!$detail) {
            // Optionally, handle the case where no data was found
            return redirect()->back()->with('error', 'Details not found.');
        }
       

        // Return the view with the detail data
        return view('pages.teachers.teacher_details', compact('detail'));
    }






    #start habilitacao   

    public function showHabilitacoes($id)
    {
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();
        $habilitacoes = HabilitacaoModel::where('id_funcionario', $id)->get();
        return view('pages.teachers.habilitacao.habilitacao_funcionario', compact('habilitacoes', 'detail'));
    }

    public function create_habilitacao($id)
    {
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();
        return view('pages.teachers.habilitacao.habilitacao_inserir', compact('detail', 'id'));
    }

    public function storeHabilitacao(Request $request)
    {
        $request->validate([
            'habilitacao' => 'required|string|max:255',
        ]);

        $habilitacao = new HabilitacaoModel();
        $habilitacao->id_funcionario = $request->input('id_funcionario');
        $habilitacao->habilitacao = $request->input('habilitacao');
        $habilitacao->area_especialidade = $request->input('area_especialidade');
        $habilitacao->universidade_origem = $request->input('universidade_origem');
        $habilitacao->save();
        return redirect()->route('habilitacao_funcionario', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Habilitação inserida com sucesso.');
    }

    // Show the form with existing data for editing
    public function editHabilitacao($id)
    {
        // Fetch the habilitacao by its ID
        $edit = HabilitacaoModel::findOrFail($id);
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_habilitacao', $id)
        ->orderByDesc('created_at')
        ->first();
        return view('pages.teachers.habilitacao.habilitacao_alterar', compact('id','detail','edit'));
    }

    // Handle the update request
    public function updateHabilitacao(Request $request, $id)
    {
        $request->validate([
            'habilitacao' => 'required|string|max:255',
            'area_especialidade' => 'required|string|max:255',
            'universidade_origem' => 'required|string|max:255',
        ]);

        $habilitacao = HabilitacaoModel::findOrFail($id); // Find the habilitacao to update
        $habilitacao->habilitacao = $request->input('habilitacao');
        $habilitacao->area_especialidade = $request->input('area_especialidade');
        $habilitacao->universidade_origem = $request->input('universidade_origem');
        $habilitacao->save(); // Save the updated habilitacao

        // Redirect back to the habilitacao page with a success message
        return redirect()->route('habilitacao_funcionario', ['id' => $habilitacao->id_funcionario])
            ->with('success', 'Habilitação updated successfully.');
    }


    public function destroyHabilitacao($id)
    {
        $habilitacao = HabilitacaoModel::findOrFail($id);
        $habilitacao->controlo_estado = 'deleted'; // Update status to 'deleted'
        $habilitacao->save();

        return redirect()->route('habilitacao_funcionario', ['id' => $habilitacao->id_funcionario])
            ->with('success', 'Habilitação Apaga Com Suceso.');
    }

    #end Habilitacao

    #start Horarrio
    public function horario($id)
    {
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();
        $horario = ModelHorario::all();
        return view('pages.teachers.horario.horario_ensinar', compact('detail','horario'));
    }
    #end horario

    #start Estatuto...
    public function estatuto($id)
    {
        // $estatuto = FuncionarioEstatutoModel::where('id_funcionario', $id)->get();
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();
        $estatuto = DB::table('view_estatuto_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('pages.teachers.estatuto.estatuto_funcionario', compact('estatuto', 'detail'));
    }


    public function create_estatuto($id)
    {
        $estatuto = ModelEstatuto::all();
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();
        return view('pages.teachers.estatuto.estatuto_inserir', compact('detail', 'id', 'estatuto'));
    }

    public function storeEstatuto(Request $request)
    {
        $request->validate([
            'id_estatuto' => 'required|string|max:255',
        ]);

        $estatuto = new FuncionarioEstatutoModel();
        $estatuto->id_funcionario = $request->input('id_funcionario');
        $estatuto->id_estatuto = $request->input('id_estatuto');
        $estatuto->data_inicio = $request->input('data_inicio');
        $estatuto->data_fim = $request->input('data_fim');
        $estatuto->save();

        return redirect()->route('estatuto', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Estatuto Funcionarios inserida com sucesso.');
    }


    public function editEstatuto($id)
    {
        // Fetch the habilitacao by its ID
        $estatuto = ModelEstatuto::all();
        $edit = FuncionarioEstatutoModel::findOrFail($id);
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_estatuto_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();
        // Return the edit view and pass the habilitacao data
        return view('pages.teachers.estatuto.estatuto_alterar', compact('id', 'estatuto', 'detail','edit'));
    }

    public function updateEstatuto(Request $request, $id)
    {
        $request->validate([
            'id_estatuto' => 'required|string|max:255',
            'data_inicio' => 'required|string|max:255',

        ]);

        $estatuto = FuncionarioEstatutoModel::findOrFail($id); // Find the habilitacao to update
        $estatuto->id_estatuto = $request->input('id_estatuto');
        $estatuto->data_inicio = $request->input('data_inicio');
        $estatuto->data_fim = $request->input('data_fim');
        $estatuto->save(); // Save the updated habilitacao

        // Redirect back to the habilitacao page with a success message
        return redirect()->route('estatuto', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Estatuto Funcionarios Atualizar com sucesso.');
    }

    public function destroyEstatuto($id)
    {
        // Check if the record exists before attempting deletion
        $estatuto = DB::table('estatuto_funcionario')->where('id_estatuto_funcionario', $id)->first();

        if ($estatuto) {
            // Perform the delete action
            DB::table('estatuto_funcionario')->where('id_estatuto_funcionario', $id)->delete();

            return redirect()->back()->with('success', 'estatuto funcionario apaga com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Estatuto not found.');
        }
    }

    #end estatuto

    #start departamento
    public function showDepartamento($id)
    {
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();
            
            $depfun = DB::table('departamento_funcionario as a')
            ->leftJoin('departamento as b', 'b.id_departamento', '=', 'a.id_departamento')
            ->leftJoin('faculdade as c', 'c.id_faculdade', '=', 'a.id_faculdade')
            ->leftJoin('funcionario as d', 'd.id_funcionario', '=', 'a.id_funcionario')
            ->select(
                'a.id_departamento_funcionario',
                'b.id_departamento',
                'b.nome_departamento',
                'c.id_faculdade',
                'c.nome_faculdade',
                'd.id_funcionario',
                'd.nome_funcionario',
                'a.data_inicio',
                'a.data_fim',
                'a.controlo_estado'
            )
            ->where('d.id_funcionario', $id)
            ->whereNull('a.controlo_estado')
            ->orderBy('a.data_inicio','DESC')
            ->paginate(5);
          
        return view('pages.teachers.departamento.departamento', compact('depfun', 'detail'));
    }


    public function create_departamento($id)
    {
        $fac = DB::table('faculdade')->paginate(10);
      
        $dep = ModelDepartamento::all();
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();
        return view('pages.teachers.departamento.departamento_inserir', compact('detail', 'id', 'dep','fac'));
    }

    public function storeDepartamento(Request $request)
    {
        $request->validate([
            'id_departamento' => 'required|string|max:255',
            
        ]);

        $departamento = new ModelFuncionarioDepartamento();
        $departamento->id_funcionario = $request->input('id_funcionario');
        $departamento->id_faculdade = $request->input('id_faculdade');
        $departamento->id_departamento = $request->input('id_departamento');
        $departamento->data_inicio = $request->input('data_inicio');
        $departamento->data_fim = $request->input('data_fim');
        $departamento->save();

        return redirect()->route('departamento', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Departamento Funcionarios inserida com sucesso.');
    }



    public function editDepartamento($id)
    {
        

        $dep = ModelDepartamento::all();
        $fac = DB::table('faculdade')->paginate(10);
        $edit = ModelFuncionarioDepartamento::findOrFail($id);
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_departamento_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();
        
       
         
        return view('pages.teachers.departamento.departamento_alterar', compact('id', 'edit','fac','dep','detail'));
    }


    public function updateDepartamento(Request $request, $id)
    {
        $request->validate([
            'id_departamento' => 'required|string|max:255',
            'id_faculdade' => 'required|string|max:255',

        ]);

        $departamento = ModelFuncionarioDepartamento::findOrFail($id); // Find the habilitacao to update
        $departamento->id_departamento = $request->input('id_departamento');
        $departamento->id_faculdade = $request->input('id_faculdade');
        $departamento->id_funcionario = $request->input('id_funcionario');
        $departamento->data_inicio = $request->input('data_inicio');
        $departamento->data_fim = $request->input('data_fim');
        $departamento->save(); // Save the updated habilitacao

        // Redirect back to the habilitacao page with a success message
        return redirect()->route('departamento', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Departamento Funcionarios Atualizar com sucesso.');
    }

    public function destroyDepartamento($id)
    {
        // Check if the record exists before attempting deletion
        $estatuto = DB::table('departamento_funcionario')->where('id_departamento_funcionario', $id)->first();

        if ($estatuto) {
            // Perform the delete action
            DB::table('departamento_funcionario')->where('id_departamento_funcionario', $id)->delete();

            return redirect()->back()->with('success', 'Departamento funcionario apaga com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Estatuto not found.');
        }
    }
    #end departamento


    #materia docente start
    public function showMateria($id)
    {
        // Busca detalhes do funcionário
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();
    
        // Busca as matérias do docente filtradas por id_funcionario e id_semestre
        $materiadocen = DB::table('view_docente_materia_estudante')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->get();
    
        // Retorna a view com os dados
        return view('pages.teachers.materia.materia_docente', compact('materiadocen', 'detail'));
    }
    

    public function create_materiaDocente($id)
    {
        $materia = ModelMateria::all();
        $semestre =ModelSemestre::all();
        $departamento =ModelDepartamento::all();
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();
            
        return view('pages.teachers.materia.materia_docente_inserir', compact('detail', 'id', 'materia','semestre','departamento'));
    }


    public function getSemestreByDepartamento(Request $request)
{
    $id_departamento = $request->id_departamento;

    $semestres = DB::table('view_materia_semestre')
        ->select('id_semestre', 'numero_semestre')
        ->where('id_departamento', $id_departamento)
        ->groupBy('id_semestre', 'numero_semestre')
        ->get();

    return response()->json($semestres);
}


public function getMateriaSemestreBySemestre(Request $request)
{
    $id_semestre = $request->id_semestre;

    $materiasemestres = DB::table('view_materia_semestre')
        ->select('id_materia_semestre', 'materia', 'numero_semestre')
        ->where('id_semestre', $id_semestre)
        ->get();

    return response()->json($materiasemestres);
}

    


    public function storeDocenteMateria(Request $request)
    {
        $request->validate([
            'id_materia_semestre' => 'required|string|max:255',            
            
        ]);
 
        $materia_docente = new ModelDocenteDaMateria();
        $materia_docente->id_funcionario = $request->input('id_funcionario');
        $materia_docente->id_materia_semestre= $request->input('id_materia_semestre');
        // $materia_docente->id_materia = $request->input('id_materia');
        $materia_docente->data_inicio_aula = $request->input('data_inicio_aula');
        $materia_docente->data_fim_aula = $request->input('data_fim_aula');
        $materia_docente->ano_academico = $request->input('ano_academico');
        $materia_docente->estado_de_aula = $request->input('estado_de_aula');
        $materia_docente->observacao = $request->input('observacao');
        $materia_docente->save();
        return redirect()->route('materia_docente', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Materia Docentes inserida com sucesso.');
    }

    public function editDocentemateria($id)
    {
        $materia = DB::table('view_materia_semestre')
        ->where('id_materia_semestre', $id)
        
        ->get();    
       
        $edit = DB::table('view_docente_materia')
        ->where('id_docente_materia', $id)
        ->orderByDesc('created_at')
        ->get();
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_docente_materia', $id)
        ->orderByDesc('created_at')
        ->first();
        // $edit = ModelDocenteDaMateria::findOrFail($id);     
        $semestre = ModelSemestre::all();   
          
        return view('pages.teachers.materia.materia_docente_alterar', compact('id', 'detail','edit','materia','semestre'));
    }

    public function updateDocentemateria(Request $request, $id)
    {
        $request->validate([
            'id_materia' => 'required|string|max:255',
            'id_funcionario' => 'required|string|max:255',

        ]);

        $docente = ModelDocenteDaMateria::findOrFail($id); // Find the habilitacao to update
        $docente->id_materia = $request->input('id_materia');
        $docente->data_inicio = $request->input('data_inicio');
        $docente->data_fim = $request->input('data_fim');
        $docente->id_funcionario = $request->input('id_funcionario');
        $docente->observacao = $request->input('observacao');
        $docente->save(); // Save the updated habilitacao

        // Redirect back to the habilitacao page with a success message
        return redirect()->route('materia_docente', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Materia Docente Atualizar com sucesso.');
    }

    public function destroyDocentemateria($id)
    {
        // Check if the record exists before attempting deletion
        $estatuto = DB::table('docente_materia')->where('id_docente_materia', $id)->first();

        if ($estatuto) {
            // Perform the delete action
            DB::table('docente_materia')->where('id_docente_materia', $id)->delete();

            return redirect()->back()->with('success', 'Materia Docente apaga com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Materia not found.');
        }
    }




    public function DetailDocenteSemestreEstudante($id)
    {
        // Fetch the detail data from the view_gfuncionario view based on id_funcionario
        $load_id = DB::table('view_docente_materia_estudante')
            ->where('id_docente_materia', $id)
            ->orderByDesc('created_at')
            ->first();
           
        // Check if the data was found
        if (!$load_id) {
            // Optionally, handle the case where no data was found
            return redirect()->back()->with('error', 'Details not found.');
        }

        $detailho_docente_semestre_estudante = DB::table('view_docente_materia_estudante')
        ->where('id_docente_materia', $id)
        ->paginate(10);

   
       
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_docente_materia', $id)
        ->orderByDesc('created_at')
        ->first();

        $anos = DB::table('view_docente_materia_estudante')
        ->where('id_semestre', $id) // Use the same $id for the department
        ->distinct()
        ->pluck('ano_academico');
       

        // Return the view with the detail data
        return view('pages.teachers.materia.detail_docente_semestre_estudante', compact('detail','detailho_docente_semestre_estudante','load_id','anos'));
    }


 

    



    public function InserirValorEstudante ($id)
    {
        $valor_estudante = DB::table('view_docente_materia_estudante')
        ->where('id_student', $id)
        ->orderByDesc('created_at')
        ->first();
        return view('pages.teachers.materia.valor_estudante.valor_inserir', compact('valor_estudante'));
    }





public function storeValor(Request $request)
{
    $request->validate([
        'id_student' => 'required|string|max:255', 
        'id_materia_semestre' => 'required|string|max:255',      
        'valor' => 'required|numeric|min:0',      
        
    ]);

    $valor = new ModelvalorEstudante();
    $valor->id_student = $request->input('id_student');
    $valor->id_materia_semestre= $request->input('id_materia_semestre');
    $valor->valor = $request->input('valor');
    $valor->observacao = $request->input('observacao');
    
    $valor->save();
    return redirect()->back()->with('success', 'valor sucesso gravado!');
    // return redirect()->route('materia_docente', ['id' => $request->input('id_funcionario')])
    //     ->with('success', 'Materia Docentes inserida com sucesso.');
}

public function updateValor(Request $request)
{
    // Validate the input
    $request->validate([
        'id_student' => 'required|string|max:255',
        'id_materia_semestre' => 'required|string|max:255',
        'valor' => 'required|numeric|min:0',
    ]);

    // Find the existing record
    $valor = ModelvalorEstudante::where('id_student', $request->input('id_student'))
        ->where('id_materia_semestre', $request->input('id_materia_semestre'))
        ->first();

    if (!$valor) {
        // If record does not exist, return an error message
        return redirect()->back()->with('error', 'Registro não encontrado para atualizar.');
    }

    // Update the record
    $valor->valor = $request->input('valor');
    $valor->observacao = $request->input('observacao');
    $valor->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Valor atualizado com sucesso!');
}




public function exportToPDF($id)
{
    // Fetch data from the view
    $data = DB::table('view_docente_materia_estudante')
        ->where('id_docente_materia', $id)
        ->get();

    // Extract header information
    $numero_semestre = $data->first()->numero_semestre ?? 'N/A';
    $departamento_estudante = $data->first()->departamento_estudante ?? 'N/A';
    $ano_academico = $data->first()->ano_academico ?? 'N/A';

    // Create a new TCPDF instance
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator('Laravel App');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Lista de Valores dos Estudantes');
    $pdf->SetSubject('Exported Valor Data');

    // Set default header data
    $pdf->SetHeaderData(
        '',  // No logo
        0,   // Logo width
        "Lista de Valores dos Estudantes", 
        "Semestre: $numero_semestre | Departamento: $departamento_estudante | Ano Acadêmico: $ano_academico\nGerado em " . now()->format('d/m/Y H:i')
    );

    // Set header and footer fonts
    $pdf->setHeaderFont(['helvetica', '', 10]);
    $pdf->setFooterFont(['helvetica', '', 8]);

    // Set margins
    $pdf->SetMargins(15, 27, 15);
    $pdf->SetHeaderMargin(5);
    $pdf->SetFooterMargin(10);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(true, 25);

    // Add a page
    $pdf->AddPage();

    // Define the table content
    $html = '<h3 style="text-align: center;">Lista de Valores dos Estudantes</h3>';
    $html .= '<table border="1" cellpadding="4" cellspacing="0" style="width: 100%; font-size: 8px;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th>NRE</th>
                        <th>Nome</th>
                        <th>Departamento</th>
                        <th>Semestre</th>
                        <th>Disciplina</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>';

    // Populate the table with data
    foreach ($data as $row) {
        $html .= '<tr>
                    <td>' . $row->nre . '</td>
                    <td>' . $row->complete_name . '</td>
                    <td>' . $row->departamento_estudante . '</td>
                    <td>' . $row->numero_semestre . '</td>
                    <td>' . $row->codigo_materia . ' - ' . $row->materia . '</td>
                    <td>' . ($row->valor ?? 'N/A') . '</td>
                </tr>';
    }

    $html .= '</tbody></table>';

    // Write the HTML content to the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output the PDF (force download)
    $pdf->Output('Lista_Valores_Estudantes.pdf', 'D');
}




    #end



   

    /*  public function restore($id)
        {
            // Find the docente by its ID
            $docente = ModelDocente::findOrFail($id);
            
            // Set `controlo_estado` back to the default value (e.g., 'active')
            $docente->controlo_estado = 'active';
            $docente->save();
            
            // Redirect with success message
            return redirect()->route('docentes')->with('success', 'Docente restored successfully');
        }
 */

         public function report(Request $request)
        {
            

            return view('pages.teachers.report_teacher');
        }

        public function getFuncionarioReport(Request $request)
        {
            if ($request->ajax()) {
            
                // Use DB query without pagination as DataTables will handle pagination
                $data = DB::table('view_monitoramento_funcionario')->select('*');
                
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $editUrl = route('editar', $row->id_funcionario);
                        $detailUrl = route('detailho', $row->id_funcionario);
                        $deleteUrl = route('docentes.destroy', $row->id_funcionario); // Delete route
                        // Create Edit button
                        $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Edit</a>';
                        
                        // Append Detail button
                        $btn .= ' <a href="' . $detailUrl . '" class="detail btn btn-info btn-sm">Detail</a>';
                    

                        // $btn .= ' <button type="button" class="delete btn btn-danger btn-sm" onclick="confirmDelete(\'' . $deleteUrl . '\')">Delete</button>';
                        
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }

    
     public function exportPDF(Request $request)
    {
        // Fetch filtered data based on request parameters
        // $query = ModelDocente::query();
        $query = DB::table('view_monitoramento_funcionario');
        if ($request->sexo) {
            $query->where('sexo', $request->sexo);
        }

        if ($request->data_moris) {
            $query->where('data_moris', $request->data_moris);
        }

        if ($request->categoria) {
            $query->where('categoria', $request->categoria);
        }

        $funcionarios = $query->get();

        // Initialize TCPDF
        $pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Instituto Ciência de Saúde (ICS)');
        $pdf->SetTitle('Relatório de Funcionários');
        $pdf->SetSubject('Funcionários');

        // Add a page
        $pdf->AddPage();

        // Path to the logo image
        $logoPath = public_path('/images/logo_con.png'); // Adjust the path accordingly

        // Create the custom header HTML similar to your provided image
        $headerHtml = '
        <table cellpadding="7" cellspacing="0" border="0" style="width:100%; text-align: center;">
        
                <tr>
                <td>
                <img src="' . $logoPath . '" alt="Logo" height="30" />
                    <h5 style="font-size: 8px; margin: 0;">FUNDAÇÃO GRAÇA DEUS</h5>
                    <h5 style="font-size: 8px; margin: 0;">INSTITUTO DE CIÊNCIAS DA SAÚDE</h5>
                    <p style="font-size: 7px; margin: 0;">ACREDITADA</p>
                    <p style="font-size: 7px; margin: 0;">Rua de Moris Foun, Comoro, Dili, Timor – Leste</p>
                    <p style="font-size: 7px; margin: 0;">Telemovel (+670) 76546180</p>
                </td>
            </tr>
        </table>';

        // Write the header to the PDF
        $pdf->writeHTML($headerHtml, true, false, true, false, '');

        // Add a bit of space between the header and the table
        $pdf->Ln(2);

        // Create table header with numbering column
        $html = '
        
        <h5 style="text-align: left; font-family: Arial, sans-serif;">I.Lista dos Funcionários</h5>
        <table border="1" cellpadding="4" cellspacing="0" style="width:100%; border-collapse:collapse; font-size: 7px; font-family: Arial, sans-serif;">
            <thead>
                <tr style="background-color: #f2f2f2; color: #333; text-align: center;">
                    <th style="border: 1px solid #ddd; padding: 0px;">No.</th>
                    <th style="border: 1px solid #ddd; padding: 12px;">Nome</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Sexo</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Data Moris</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Categoria</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Departamento</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Tipo Contrato</th>
                     <th style="border: 1px solid #ddd; padding: 8px;">Nivel Educação</th>
                </tr>
            </thead>
            <tbody>';

        // Loop through the data and generate table rows with numbering
        $number = 1;
        foreach ($funcionarios as $funcionario) {
            $estado = $funcionario->controlo_estado === null ? 'Ativo' : 'Nao Ativo';
            $html .= '
                <tr style="text-align: center;">
                    <td style="border: 1px solid #ddd; padding: 8px;">' . $number++ . '</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->nome_funcionario . ', ' . $funcionario->titulu . '</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->sexo . '</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">' . date('d-m-Y', strtotime($funcionario->data_moris)) . '</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->categoria . '</td>
                   <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->nome_departamento . '</td>
                   <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->estatuto . '</td>
                   <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->habilitacao . '</td>

                </tr>';
        }

        $html .= '</tbody></table>';

        // Write the table content into the PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output the PDF
        return $pdf->Output('funcionarios_report.pdf', 'D'); // D = download, I = inline display
    }

        
        

        public function import_excel_docente(Request $request)
        {
            $request->validate([
                'excel_file' => 'required|file|mimes:xlsx,xls,csv',
            ]);
        
            // Import the Excel file
            Excel::import(new TeacherImport, $request->file('excel_file'));
    
            
            return redirect()->route('funcionarios.index')->with('success', 'Dadus  Importa com sucesso!');
        }


    public function showPozisaun($id)
    {
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();
            
           

     $pozisaunFuncionario = DB::table('pozisaun_funcionario as a')
    ->leftJoin('funcionario as b', 'b.id_funcionario', '=', 'a.id_funcionario')
    ->select(
        'a.id_pozisaun_funcionario',
        'b.id_funcionario',
        'a.nome_pozisaun',
        'a.data_inicio',
        'a.data_fim',
        'a.estado',
        'a.created_at',
        'a.updated_at',
        'a.deleted_at'
    )
    ->where('b.id_funcionario', $id)
    ->whereNull('a.estado')
    ->orderByDesc('created_at')
    ->get();

          
        return view('pages.teachers.pozisaun.pozisaun_funcionario', compact('detail','pozisaunFuncionario'));
    }

    public function createPozisaun($id)
    {
        $pozisaun = ModelPozisaunFuncionario::all();
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();
        return view('pages.teachers.pozisaun.pozisaun_inserir', compact('detail', 'id', 'pozisaun'));
    }

    public function storePozisaun(Request $request)
    {
        $request->validate([
            'nome_pozisaun' => 'required|string|max:255',
            'data_inicio' => 'required|string|max:255',
        ]);

        $pozisaun = new ModelPozisaunFuncionario();
        $pozisaun->id_funcionario = $request->input('id_funcionario');
        $pozisaun->nome_pozisaun = $request->input('nome_pozisaun');
        $pozisaun->data_inicio = $request->input('data_inicio');
        $pozisaun->data_fim = $request->input('data_fim');
        $pozisaun->save();

        return redirect()->route('posicao_funcionario', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Posição inserida com sucesso.');
    }

    public function editPozisaun($id)
    {
      
        $edit = ModelPozisaunFuncionario::findOrFail($id);
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_pozisaun_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();
        return view('pages.teachers.pozisaun.edit_pozisaun_funcionario', compact('id','detail','edit'));
    }

    public function update_posicao(Request $request, $id)
    {
      
        $request->validate([
            'nome_pozisaun' => 'required|string|max:255',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date',
        ]);

        $pozisaun = ModelPozisaunFuncionario::findOrFail($id); 
        $pozisaun->nome_pozisaun = $request->input('nome_pozisaun');
        $pozisaun->data_inicio = $request->input('data_inicio');
        $pozisaun->data_fim = $request->input('data_fim');
        $pozisaun->save(); // Save the updated habilitacao

        // Redirect back to the habilitacao page with a success message
        return redirect()->route('posicao_funcionario', ['id' => $pozisaun->id_funcionario])
            ->with('success', 'posição Atualiza com sucesso .');
    }

    public function destroyPozisaun($id)
    {
        $posicao = ModelPozisaunFuncionario::findOrFail($id);
        $posicao->estado = 'deleted'; // Update status to 'deleted'
        $posicao->save();

        return redirect()->route('posicao_funcionario', ['id' => $posicao->id_funcionario])
            ->with('success', 'Posição do Funcionario Desabilitar Com Suceso.');
    }

#start nacionalidade
    public function create_naturalidade($id)
    {
        $pozisaun = ModelPozisaunFuncionario::all();
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();
            

         $municipios = ViewMunicipioPosto::select('id_municipio', 'municipio')
         ->distinct()
         ->get();
        return view('pages.teachers.naturalidade.naturalidade_inserir', compact('detail', 'id', 'pozisaun','municipios'));
    }

    public function storeNaturalidade(Request $request)
    {
        $request->validate([
         'id_aldeias' => 'required|string|max:255',
         'id_suco' => 'required|string|max:255',
         'id_posto_administrativo' => 'required|string|max:255',
         'id_municipio' => 'required|string|max:255',
        ]);

        $naturalidade = new ModelNaturalidadeFuncionario();
        $naturalidade->id_funcionario = $request->input('id_funcionario');
        $naturalidade->id_municipio = $request->input('id_municipio');
        $naturalidade->id_posto_administrativo = $request->input('id_posto_administrativo');
        $naturalidade->id_suco = $request->input('id_suco');
        $naturalidade->id_aldeias = $request->input('id_aldeias');
        $naturalidade->nacionalidade = $request->input('nacionalidade');
        $naturalidade->endereco_atual = $request->input('endereco_atual');
        $naturalidade->observacao = $request->input('observacao');
        $naturalidade->save();

        return redirect()->route('detailho', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Naturalidade inserida com sucesso.');
    }

    public function editNaturalidade($id)
    {
        // Fetch the habilitacao by its ID
        $edit = ModelNaturalidadeFuncionario::findOrFail($id);

        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_naturalidade_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();

        $municipios = ViewMunicipioPosto::select('id_municipio', 'municipio')
        ->distinct()
        ->get();
        return view('pages.teachers.naturalidade.naturalidade_alterar', compact('id','detail','edit','municipios'));
    }
}
