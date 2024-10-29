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
use TCPDF;
Use App\Http\Controllers\Storage;
use App\Http\Controllers\rawcolumns;
use App\Imports\TeacherImport;
// Atu View karik bele bolu hanesan ne
#$postoAdministrativoData = ModelGdivisaoAdministrativaPostoAdministrativo::all();
#$sucosAldeiasData = ModelGdivisaoAdministrativaSucosAldeias::all();


class DocenteController extends Controller
{



    public function escolhaDados()
    {
     
        // $departamento = ModelDepartamento::all();
      
        // $departamento = DB::table('view_docente')->select('id_departamento')->distinct()->get();
        $departamento = DB::table('funcionario as a')
        ->select(
            'h.id_departamento',
            'h.nome_departamento',
            DB::raw('COUNT(a.id_funcionario) as total_funcionarios')
        )
        ->leftJoin('departamento_funcionario as g', 'g.id_funcionario', '=', 'a.id_funcionario')
        ->leftJoin('departamento as h', 'h.id_departamento', '=', 'g.id_departamento')
        ->groupBy('h.id_departamento', 'h.nome_departamento')
        ->get();

        return view('pages.teachers.escolha_modul_docente', compact('departamento'));

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
            $data = DB::table('view_gfuncionario')->select('*');
            
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

 public function store(Request $request): RedirectResponse
 {
     // Validation Rules
     $validatedData = $request->validate([
         'nome_funcionario' => 'required|string|max:255',
         'sexo' => 'required|string|max:255',
         'data_moris' => 'required|date',
         'id_aldeias' => 'required|string|max:255',
         'id_suco' => 'required|string|max:255',
         'id_posto_administrativo' => 'required|string|max:255',
         'id_municipio' => 'required|string|max:255',
         'nacionalidade' => 'nullable|string|max:255',
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
         'id_aldeias' => $validatedData['id_aldeias'],
         'id_suco' => $validatedData['id_suco'],
         'id_posto_administrativo' => $validatedData['id_posto_administrativo'],
         'id_municipio' => $validatedData['id_municipio'],
         'nacionalidade' => $validatedData['nacionalidade'],
         'id_tipo_categoria' => $id_tipo_categoria,
         'ano_inicio' => $validatedData['ano_inicio'],
         'observacao' => $validatedData['observacao'],
         'no_contacto' => $validatedData['no_contacto'],
         'email' => $validatedData['email'],
         'categoria' => $validatedData['categoria'],
         'titulu' => $validatedData['titulu']
     ]);
 
     // Create associated user record
     ModelUser::create([
         'user_id' => (string) Str::uuid(),
         'username' => $funcionarios->nome_funcionario, // Assuming 'nre' refers to 'nome_funcionario'
         'email' => $request->email ?? null,
         'password' => Hash::make('defaultpassword'), // Default password, replace with logic to generate a secure password
         'docente_student_id' => $funcionarios->id_funcionario,
         'tipo_usuario' => $funcionarios->categoria,
     ]);
 
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
        // $estatuto = FuncionarioEstatutoModel::where('id_funcionario', $id)->get();
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();
        $materiadocen = DB::table('docente_materia as a')
        ->leftJoin('materia as b', 'b.id_materia', '=', 'a.id_materia')
      
        ->leftJoin('funcionario as d', 'd.id_funcionario', '=', 'a.id_funcionario')
        ->select(
            'a.id_docente_materia',
            'a.data_inicio',
            'a.data_fim',
            'b.id_materia',
            'b.materia',            
            'd.id_funcionario',
            'd.nome_funcionario',
            'a.controlo_estado'
        )
        ->where('d.id_funcionario', $id)
        ->whereNull('a.controlo_estado')
        // ->get();
        ->paginate(5);
        return view('pages.teachers.materia.materia_docente', compact('materiadocen', 'detail'));
    }

    public function create_materiaDocente($id)
    {
        $materia = ModelMateria::all();
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();
        return view('pages.teachers.materia.materia_docente_inserir', compact('detail', 'id', 'materia'));
    }

    public function storeDocenteMateria(Request $request)
    {
        $request->validate([
            'id_materia' => 'required|string|max:255',            
            
        ]);
 
        $materia_docente = new ModelDocenteDaMateria();
        $materia_docente->id_funcionario = $request->input('id_funcionario');
        $materia_docente->id_materia = $request->input('id_materia');
        $materia_docente->data_inicio = $request->input('data_inicio');
        $materia_docente->data_fim = $request->input('data_fim');
        $materia_docente->observacao = $request->input('observacao');
        $materia_docente->save();
        return redirect()->route('materia_docente', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Materia Docentes inserida com sucesso.');
    }

    public function editDocentemateria($id)
    {
               
        $materia = ModelMateria::all();
        $detail = DB::table('view_monitoramento_funcionario')
        ->where('id_departamento_funcionario', $id)
        ->orderByDesc('created_at')
        ->first();
        $edit = ModelDocenteDaMateria::findOrFail($id);       
        
        return view('pages.teachers.materia.materia_docente_alterar', compact('id', 'detail','edit','materia'));
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
    $query = ModelDocente::query();

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
    $logoPath = public_path('/asset/images/logo.jpg'); // Adjust the path accordingly

    // Create the custom header HTML similar to your provided image
    $headerHtml = '
    <table cellpadding="5" cellspacing="0" border="0" style="width:100%; text-align: center;">
        <tr>
            <td>
                <img src="' . $logoPath . '" alt="Logo" height="50" />
            </td>
        </tr>
        <tr>
            <td>
                <h4 style="font-size: 14px; margin: 0;">FUNDAÇÃO GRAÇA DEUS</h4>
                <h5 style="font-size: 12px; margin: 0;">INSTITUTO DE CIÊNCIAS DA SAÚDE</h5>
                <p style="font-size: 10px; margin: 0;">ACREDITADA</p>
                <p style="font-size: 10px; margin: 0;">Rua de Moris Foun, Comoro, Dili, Timor – Leste</p>
                <p style="font-size: 10px; margin: 0;">Telemovel (+670) 76546180</p>
            </td>
        </tr>
    </table>';

    // Write the header to the PDF
    $pdf->writeHTML($headerHtml, true, false, true, false, '');

    // Add a bit of space between the header and the table
    $pdf->Ln(10);

    // Create table header with numbering column
    $html = '
    <h3 style="text-align: center; font-family: Arial, sans-serif;">Lista dos Funcionários</h3>
    <table border="1" cellpadding="4" cellspacing="0" style="width:100%; border-collapse:collapse; font-size: 11px; font-family: Arial, sans-serif;">
        <thead>
            <tr style="background-color: #f2f2f2; color: #333; text-align: center;">
              
                <th style="border: 1px solid #ddd; padding: 8px;">Nome</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Sexo</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Data Moris</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Categoria</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Estado</th>
            </tr>
        </thead>
        <tbody>';

    // Loop through the data and generate table rows with numbering
    $number = 1;
    foreach ($funcionarios as $funcionario) {
        $estado = $funcionario->controlo_estado === null ? 'Ativo' : 'Nao Ativo';
        $html .= '
            <tr style="text-align: center;">
                
                <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->nome_funcionario . '</td>
                <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->sexo . '</td>
                <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->data_moris . '</td>
                <td style="border: 1px solid #ddd; padding: 8px;">' . $funcionario->categoria . '</td>
                <td style="border: 1px solid #ddd; padding: 8px;">' . $estado . '</td>
            </tr>';
    }

    $html .= '</tbody></table>';

    // Write the table content into the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output the PDF
    return $pdf->Output('funcionarios_report.pdf', 'D'); // D = download, I = inline display
}

        
        



        public function import_excel_post(Request $request)
        {
            $request->validate([
                'excel_file' => 'required|file|mimes:xlsx,xls,csv',
            ]);
        
            // Import the Excel file
            Excel::import(new TeacherImport, $request->file('excel_file'));
    
            
            return redirect()->route('students.index')->with('success', 'Dadus funcionario Importa com sucesso!');
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
}
