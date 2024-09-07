<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\ModelDocente;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;


class DocenteController extends Controller
{
    public function index()
    {
        // $docente = ModelDocente::all(); // Assuming you have a Docente model
        $docente = ModelDocente::paginate(10);
    
        return view('pages.teachers.all_teachers', compact('docente'));
    }
    

    public function showDetail($id)
    {
        $detail = ModelDocente::findOrFail($id);
        return view('pages.teachers.teacher_details', compact('detail'));
    }

    public function show(string $id)
    {
    
        // Retrieve detail of the pessoa by ID
        $detail = ModelDocente::findOrFail($id);  
        // Return the view with the retrieved detail and atividades
        return view('pages.teachers.teacher_details', compact('detail'));
    }


    public function habilitacao(string $id)
    {
        $docente = ModelDocente::all(); // Assuming you have a Docente model
        // $docente = ModelDocente::paginate(10);
        $detail = ModelDocente::findOrFail($id);  
        return view('pages.teachers.habilitacao_docente', compact('docente','detail'));
    }
       


    // docente adicionar
    public function formDocente()
    {
        // $docente = ModelDocente::all(); // Assuming you have a Docente model
        $docente = ModelDocente::paginate(10);
    
        return view('pages.teachers.add_teacher', compact('docente'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validation Rules
        $validated = $request->validate([
            'nome_docente' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'data_moris' => 'required|date',
            'suco' => 'required|string|max:255',
            'posto_administrativo' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'nacionalidade' => 'nullable|string|max:255',
            'nivel_educacao' => 'nullable|string|max:255',
            'area_especialidade' => 'nullable|string|max:255',
            'categoria_estatuto' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'ano_inicio' => 'nullable|date',
            'observacao' => 'nullable|string',
        ]);
    
        // Handle File Upload if an image is provided
        $photo_docente = null;
        if ($request->hasFile('photo_docente')) {
            $image = $request->file('photo_docente');
            $photo_docente = $image->hashName(); // Generate a unique name for the image
            $image->storeAs('public/asset/posts', $photo_docente);
        }
    
        // Create a new record in the database
        ModelDocente::create([
            'photo_docente' => $photo_docente, // Use the photo name if available, otherwise null
            'nome_docente' => $validated['nome_docente'],
            'sexo' => $validated['sexo'],
            'data_moris' => $validated['data_moris'],
            'suco' => $validated['suco'],
            'posto_administrativo' => $validated['posto_administrativo'],
            'municipio' => $validated['municipio'],
            'nacionalidade' => $validated['nacionalidade'],
            'nivel_educacao' => $validated['nivel_educacao'],
            'area_especialidade' => $validated['area_especialidade'],
            'categoria_estatuto' => $validated['categoria_estatuto'],
            'departamento' => $validated['departamento'],
            'ano_inicio' => $validated['ano_inicio'],
            'observacao' => $validated['observacao']
        ]);
    
        // Redirect with Success Message
        return redirect()->route('docentes')->with(['success' => 'Dados com sucesso gravados']);    }
    


      
}
