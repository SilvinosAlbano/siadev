<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\ModelDocente;
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
use App\Models\ModelMateria;

// Atu View karik bele bolu hanesan ne
#$postoAdministrativoData = ModelGdivisaoAdministrativaPostoAdministrativo::all();
#$sucosAldeiasData = ModelGdivisaoAdministrativaSucosAldeias::all();


class DocenteController extends Controller
{


    public function index(Request $request)
    {
        // Fetching estatuto options from ModelEstatuto
        $estatutoOptions = ModelEstatuto::all();

        // Base query for searching funcionario
        $query = ModelDocente::query();


        // Filter by nome_funcionario
        if ($request->filled('nome_funcionario')) {
            $query->where('nome_funcionario', 'like', '%' . $request->nome_funcionario . '%');
        }

        // Filter by sexo
        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
        }

        // Filter by id_estatuto
        if ($request->filled('id_estatuto')) {
            $query->where('id_estatuto', $request->id_estatuto);
        }
        $docente = DB::table('view_gfuncionario')->paginate(10);

        // Calculate total counts for Masculino and Feminino
        $totalMasculino = ModelDocente::where('sexo', 'Masculino')->count();
        $totalFeminino = ModelDocente::where('sexo', 'Feminino')->count();

        // Check if no data found
        if ($docente->isEmpty()) {
            return view('pages.teachers.all_teachers', compact('docente', 'estatutoOptions', 'totalMasculino', 'totalFeminino'))
                ->with('error', 'No data found for the search criteria.');
        }

        return view('pages.teachers.all_teachers', compact('docente', 'estatutoOptions', 'totalMasculino', 'totalFeminino'));
    }



    public function showDetail($id)
    {
        // Fetch the detail data from the view_gfuncionario view based on id_funcionario
        $detail = DB::table('view_gfuncionario')
            ->where('id_funcionario', $id)
            ->first();

        // Check if the data was found
        if (!$detail) {
            // Optionally, handle the case where no data was found
            return redirect()->back()->with('error', 'Details not found.');
        }
        

        // Return the view with the detail data
        return view('pages.teachers.teacher_details', compact('detail'));
    }




    public function show($id, Request $request)
    {
        // Get the 'tab' query parameter
        $tab = $request->query('tab');

        // Determine which content to show based on the 'tab' parameter
        switch ($tab) {
            case 'habilitacao_funcionario':
                // Logic for 'habilitacao_docente'
                $content = view('pages.teachers.habilitacao.habilitacao_funcionario');
                break;

            case 'horario':
                // Logic for 'horario'
                $content = view('pages.teachers.horario');
                break;

            case 'inserir_habilitacao':
                // Logic for 'horario'
                $content = view('pages.teachers.habilitacao.habilitacao_inserir');
                break;
            case 'edit_habilitacao':
                // Logic for 'horario'
                $content = view('pages.teachers.habilitacao.habilitacao_alterar');
                break;

            case 'estatuto':
                // Logic for 'pagamento'
                $content = view('pages.teachers.estatuto.estatuto');
                break;
            case 'inserir_estatuto':
                // Logic for 'horario'
                $content = view('pages.teachers.estatuto.estatuto_inserir');
                break;

            case 'edit_estatuto':
                // Logic for 'horario'
                $content = view('pages.teachers.estatuto.estatuto_alterar');
                break;
            case 'departamento':
                // Logic for 'horario'
                $content = view('pages.teachers.departamento.departamento');
                break;


            default:            
                // Default content if 'tab' is not set or does not match any case
                $content = view('pages.teachers.identificacao');
                break;
        }

        // Return the main view with dynamic content
        return view('detailho', ['content' => $content, 'id' => $id]);
    }



    #start habilitacao   

    public function showHabilitacoes($id)
    {
        $detail = ModelDocente::findOrFail($id);
        $habilitacoes = HabilitacaoModel::where('id_funcionario', $id)->get();
        return view('pages.teachers.habilitacao.habilitacao_funcionario', compact('habilitacoes', 'detail'));
    }

    public function create_habilitacao($id)
    {
        $detail = ModelDocente::findOrFail($id);
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
        $detail = HabilitacaoModel::findOrFail($id);

        // Return the edit view and pass the habilitacao data
        return view('pages.teachers.habilitacao.habilitacao_alterar', compact('detail', 'id'));
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
            ->with('success', 'Habilitação updated successfully.');
    }

    #end Habilitacao

    #start Horarrio
    public function horario($id)
    {
        $detail = ModelDocente::findOrFail($id);
        return view('pages.teachers.horario', compact('detail'));
    }
    #end horario

    #start Estatuto...
    public function estatuto($id)
    {
        // $estatuto = FuncionarioEstatutoModel::where('id_funcionario', $id)->get();
        $detail = ModelDocente::findOrFail($id);
        $estatuto = DB::table('view_estatuto_funcionario')
            ->where('id_funcionario', $id)
            ->paginate(10);
        return view('pages.teachers.estatuto.estatuto_funcionario', compact('estatuto', 'detail'));
    }


    public function create_estatuto($id)
    {
        $estatuto = ModelEstatuto::all();
        $detail = ModelDocente::findOrFail($id);
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
        // $editar = DB::table('view_estatuto_funcionario')
        // ->where('id_funcionario', $id);

        $estatuto = ModelEstatuto::all();
        $detail = FuncionarioEstatutoModel::findOrFail($id);
        // Return the edit view and pass the habilitacao data
        return view('pages.teachers.estatuto.estatuto_alterar', compact('id', 'estatuto', 'detail'));
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
        // $estatuto = FuncionarioEstatutoModel::where('id_funcionario', $id)->get();
        $detail = ModelDocente::findOrFail($id);
        // $depfun = DB::table('view_departamento_funcionario')
        //     ->where('id_funcionario', $id)
        //     ->paginate(10);

            
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
                'a.controlo_estado'
            )
            ->where('d.id_funcionario', $id)
            ->whereNull('a.controlo_estado')
            // ->get();
            ->paginate(5);
          
        return view('pages.teachers.departamento.departamento', compact('depfun', 'detail'));
    }


    public function create_departamento($id)
    {
        $fac = DB::table('faculdade')->paginate(10);
      
        $dep = ModelDepartamento::all();
        $detail = ModelDocente::findOrFail($id);
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
        $departamento->save();

        return redirect()->route('departamento', ['id' => $request->input('id_funcionario')])
            ->with('success', 'Departamento Funcionarios inserida com sucesso.');
    }



    public function editDepartamento($id)
    {
        

        $dep = ModelDepartamento::all();
        $fac = DB::table('faculdade')->paginate(10);
        $detail = ModelFuncionarioDepartamento::findOrFail($id);
       
        
        return view('pages.teachers.departamento.departamento_alterar', compact('id', 'detail','fac','dep'));
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
        $detail = ModelDocente::findOrFail($id);
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
        $detail = ModelDocente::findOrFail($id);
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
      
        $detail = ModelDocenteDaMateria::findOrFail($id);       
        
        return view('pages.teachers.materia.materia_docente_alterar', compact('id', 'detail','materia'));
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



    # Start Funcionario adicionar
    public function formDocente()
    {
        $tipo_admin = (new ModelDocente())->getAllData();
        $departamento = ModelDepartamento::all(); // Assuming you have a Docente model
        $estatuto = ModelEstatuto::all();
        $docente = ModelDocente::paginate(10);
        $municipios = ViewMunicipioPosto::select('id_municipio', 'municipio')
            ->distinct()
            ->get();
        return view('pages.teachers.add_teacher', compact('docente', 'departamento', 'estatuto', 'tipo_admin', 'municipios'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validation Rules
        $validated = $request->validate([
            'nome_funcionario' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'data_moris' => 'required|date',
            'id_aldeias' => 'required|string|max:255',
            'id_suco' => 'required|string|max:255',
            'id_posto_administrativo' => 'required|string|max:255',
            'id_municipio' => 'required|string|max:255',
            'nacionalidade' => 'nullable|string|max:255',            
            'id_tipo_categoria' => 'nullable|string|max:255', // This can be nullable
            'ano_inicio' => 'nullable|date',
            'observacao' => 'nullable|string',
            'no_contacto' => 'nullable|string',
            'email' => 'nullable|string',
            'categoria' => 'required|string|max:255',
        ]);

        // Handle File Upload if an image is provided
        $photo_docente = null; // Default value if no image is uploaded
        if ($request->hasFile('photo_docente')) {
            $image = $request->file('photo_docente');
            $photo_docente = $image->hashName(); // Generate a unique name for the image
            $image->storeAs('public/asset/posts', $photo_docente); // Store the image
        }

        // Explicitly check if 'id_tipo_categoria' exists in the request
        $id_tipo_categoria = $request->has('id_tipo_categoria') ? $validated['id_tipo_categoria'] : null;

        // Create a new record in the database
        $funcionarios = ModelDocente::create([
            'id_funcionario' => (string) Str::uuid(),
            'photo_docente' => $photo_docente, // Use the photo name if available, otherwise null
            'nome_funcionario' => $validated['nome_funcionario'],
            'sexo' => $validated['sexo'],
            'data_moris' => $validated['data_moris'],
            'id_aldeias' => $validated['id_aldeias'],
            'id_suco' => $validated['id_suco'],
            'id_posto_administrativo' => $validated['id_posto_administrativo'],
            'id_municipio' => $validated['id_municipio'],
            'nacionalidade' => $validated['nacionalidade'],           
            'id_tipo_categoria' => $id_tipo_categoria, // This will be null if not provided
            'ano_inicio' => $validated['ano_inicio'],
            'observacao' => $validated['observacao'],
            'no_contacto' => $validated['no_contacto'],
            'email' => $validated['email'],
            'categoria' => $validated['categoria']
        ]);

        # Create user
        ModelUser::create([
            'user_id' => (string) Str::uuid(),
            'username' => $funcionarios->nome_funcionario, // Assuming 'nre' is actually 'nome_funcionario' or handle it properly
            'email' => $request->email ?? null, // Set email to null or receive it from request
            'password' => Hash::make('defaultpassword'), // You may want to create a random password or handle it otherwise
            'docente_student_id' => $funcionarios->id_funcionario,
            'tipo_usuario' => $funcionarios->categoria,
        ]);

        // Check if the insertion was successful
        if ($funcionarios) {
            // Redirect with Success Message
            return redirect()->route('funcionarios.index')->with(['success' => 'Dados com sucesso gravados']);
        } else {
            // Return with an error message if insertion fails
            return back()->withInput()->withErrors(['error' => 'Failed to save data.']);
        }
    }





    // editar docente
    public function edit($id)
    {
        $departamento = ModelDepartamento::all(); // Assuming you have a Docente model
        $estatuto = ModelEstatuto::all();
        $editar = ModelDocente::findOrFail($id);
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
            'id_suco' => 'required|string|max:255',
            'id_posto_administrativo' => 'required|string|max:255',
            'id_municipio' => 'required|string|max:255',
            'nacionalidade' => 'nullable|string|max:255',            
            'ano_inicio' => 'nullable|date',
            'observacao' => 'nullable|string',
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
            'id_suco' => $validated['id_suco'],
            'id_posto_administrativo' => $validated['id_posto_administrativo'],
            'id_municipio' => $validated['id_municipio'],
            'nacionalidade' => $validated['nacionalidade'],           
            'ano_inicio' => $validated['ano_inicio'],
            'observacao' => $validated['observacao']
        ]);

        // Redirect with Success Message
        return redirect()->route('funcionarios.index')->with(['success' => 'Dados Funcionario atualizados com sucesso']);
    }



    public function destroy($id)
    {
        // Find the docente by its ID
        $docente = ModelDocente::findOrFail($id);

        // Update the `controlo_estado` field to 'deleted'
        $docente->controlo_estado = 'deleted';
        $docente->save();

        // Redirect back with success message
        return redirect()->route('funcionarios.index')->with('success', 'Docente status  deleted successfully');
    }

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

    //  public function report(Request $request)
    //     {
    //         $query = ModelDocente::query();

    //         // Apply filters
    //         if ($request->filled('nome_funcionario')) {
    //             $query->where('nome_funcionario', 'like', "%{$request->nome_funcionario}%");
    //         }
    //         if ($request->filled('sexo')) {
    //             $query->where('sexo', $request->sexo);
    //         }
    //         if ($request->filled('id_estatuto')) {
    //             $query->where('id_estatuto', $request->id_estatuto);
    //         }
    //         if ($request->filled('nivel_educacao')) {
    //             $query->where('nivel_educacao', 'like', "%{$request->nivel_educacao}%");
    //         }
    //         if ($request->filled('controlo_estado')) {
    //             $controlo_estado = $request->controlo_estado == 'active' ? null : 'deleted';
    //             $query->where('controlo_estado', $controlo_estado);
    //         }

    //         $docentes = $query->paginate(10);

    //         $estatutos = ModelEstatuto::all();

    //         return view('pages.teachers.report_teacher', compact('docentes', 'estatutos'));
    //     }

    public function export(Request $request)
    {
        return Excel::download(new DocentesExport($request->all()), 'docentes.xlsx');
    }
}
