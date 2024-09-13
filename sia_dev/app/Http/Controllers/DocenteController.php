<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\ModelDocente;
use App\Models\ViewMunicipioPosto;
use App\Models\User;
use App\Models\ModelDepartamento;
use App\Models\ModelEstatuto;
use App\Models\HabilitacaoModel;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DocentesExport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


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
    
        // Get the results
        $docente = $query->paginate(10);
    
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
        
        $detail = ModelDocente::findOrFail($id);
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
    
            case 'pagamento':
                // Logic for 'pagamento'
                $content = view('pages.teachers.pagamento');
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
        return view('pages.teachers.habilitacao.habilitacao_funcionario', compact('habilitacoes','detail'));
    }

    public function create_habilitacao($id)
    {
        $detail = ModelDocente::findOrFail($id);
        return view('pages.teachers.habilitacao.habilitacao_inserir', compact('detail','id'));
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
        return view('pages.teachers.habilitacao.habilitacao_alterar', compact('detail','id'));
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

    public function horario($id)
    {
        $detail = ModelDocente::findOrFail($id);
        return view('pages.teachers.horario', compact('detail'));
    }

    public function pagamento($id)
    {
        $detail = ModelDocente::findOrFail($id);
        return view('pages.teachers.pagamento', compact('detail'));
    }

       


    // docente adicionar
    public function formDocente()
    {
        $tipo_admin = (new ModelDocente())->getAllData();
        $departamento = ModelDepartamento::all(); // Assuming you have a Docente model
        $estatuto = ModelEstatuto::all();
        $docente = ModelDocente::paginate(10);
        $municipios = ViewMunicipioPosto::select('id_municipio', 'municipio')
        ->distinct()
        ->get();
        return view('pages.teachers.add_teacher', compact('docente','departamento','estatuto','tipo_admin','municipios'));
    }

    public function store(Request $request): RedirectResponse
{
    // Validation Rules
    $validated = $request->validate([
        'nome_funcionario' => 'required|string|max:255',
        'sexo' => 'required|string|max:255',
        'data_moris' => 'required|date',
        'id_aldeia' =>'required|string|max:255',
        'id_suco' => 'required|string|max:255',
        'id_posto_administrativo' => 'required|string|max:255',
        'id_municipio' => 'required|string|max:255',
        'nacionalidade' => 'nullable|string|max:255',             
        'id_estatuto' => 'required|string|max:255',
        'id_tipo_categoria' =>'nullable|string|max:255', // This can be nullable
        'ano_inicio' => 'nullable|date',
        'observacao' => 'nullable|string',
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
        'id_aldeia' => $validated['id_aldeia'],
        'id_suco' => $validated['id_suco'],
        'id_posto_administrativo' => $validated['id_posto_administrativo'],
        'id_municipio' => $validated['id_municipio'],
        'nacionalidade' => $validated['nacionalidade'],        
        'id_estatuto' => $validated['id_estatuto'],       
        'id_tipo_categoria' => $id_tipo_categoria, // This will be null if not provided
        'ano_inicio' => $validated['ano_inicio'],
        'observacao' => $validated['observacao'],
        'categoria' => $validated['categoria']
    ]);

    # Create user
    User::create([
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
        return redirect()->route('docentes.index')->with(['success' => 'Dados com sucesso gravados']);
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
        return view('pages.teachers.edit_teacher', compact('editar','departamento','estatuto'));
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
            'id_aldeia' => 'required|string|max:255',
            'id_suco' => 'required|string|max:255',
            'id_posto_administrativo' => 'required|string|max:255',
            'id_municipio' => 'required|string|max:255',
            'nacionalidade' => 'nullable|string|max:255',           
            'id_estatuto' => 'required|string|max:255',            
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
            'id_aldeia' => $validated['id_aldeia'],
            'id_suco' => $validated['id_suco'],
            'id_posto_administrativo' => $validated['id_posto_administrativo'],
            'id_municipio' => $validated['id_municipio'],
            'nacionalidade' => $validated['nacionalidade'],            
            'id_estatuto' => $validated['id_estatuto'],            
            'ano_inicio' => $validated['ano_inicio'],
            'observacao' => $validated['observacao']
        ]);
    
        // Redirect with Success Message
        return redirect()->route('docentes')->with(['success' => 'Dados atualizados com sucesso']);
    }
    
      

    public function destroy($id)
    {
        // Find the docente by its ID
        $docente = ModelDocente::findOrFail($id);
        
        // Update the `controlo_estado` field to 'deleted'
        $docente->controlo_estado = 'deleted';
        $docente->save();
        
        // Redirect back with success message
        return redirect()->route('docentes.index')->with('success', 'Docente status  deleted successfully');
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

 public function report(Request $request)
    {
        $query = ModelDocente::query();
        
        // Apply filters
        if ($request->filled('nome_funcionario')) {
            $query->where('nome_funcionario', 'like', "%{$request->nome_funcionario}%");
        }
        if ($request->filled('sexo')) {
            $query->where('sexo', $request->sexo);
        }
        if ($request->filled('id_estatuto')) {
            $query->where('id_estatuto', $request->id_estatuto);
        }
        if ($request->filled('nivel_educacao')) {
            $query->where('nivel_educacao', 'like', "%{$request->nivel_educacao}%");
        }
        if ($request->filled('controlo_estado')) {
            $controlo_estado = $request->controlo_estado == 'active' ? null : 'deleted';
            $query->where('controlo_estado', $controlo_estado);
        }
        
        $docentes = $query->paginate(10);
        
        $estatutos = ModelEstatuto::all();
        
        return view('pages.teachers.report_teacher', compact('docentes', 'estatutos'));
    }

    public function export(Request $request)
    {
        return Excel::download(new DocentesExport($request->all()), 'docentes.xlsx');
    }


    public function getData(Request $request)
    {
        $query = ModelDocente::query();
        
        // Apply filters if necessary
        if ($request->has('nome_funcionario')) {
            $query->where('nome_funcionario', 'like', '%' . $request->nome_funcionario . '%');
        }
        if ($request->has('sexo')) {
            $query->where('sexo', $request->sexo);
        }
        if ($request->has('id_estatuto')) {
            $query->where('id_estatuto', $request->id_estatuto);
        }
        if ($request->has('nivel_educacao')) {
            $query->where('nivel_educacao', 'like', '%' . $request->nivel_educacao . '%');
        }
        if ($request->has('controlo_estado')) {
            $query->whereNull('controlo_estado', $request->controlo_estado == 'active' ? null : '!=', 'deleted');
        }

        return DataTables::of($query)
            ->editColumn('controlo_estado', function ($data) {
                return is_null($data->controlo_estado) ? 'Active' : 'Inactive';
            })
            ->make(true);
    }

}
