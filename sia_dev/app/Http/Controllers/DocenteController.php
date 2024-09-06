<?php

namespace App\Http\Controllers;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_docente' => 'required',
            'sexo' => 'required',
            'municipio' => 'required',
            'posto_administrativo' => 'required',
            'suco' => 'required',
            'data_moris' => 'required|date',
            'nacionalidade' => 'required',
            'categoria_estatuto' => 'required',
            'departamento' => 'required',
           
        ]);

        // Handle file upload for docente photo
        if ($request->hasFile('photo_docente')) {
            $fileName = time() . '.' . $request->photo_docente->extension();
            $request->photo_docente->move(public_path('images/docentes'), $fileName);
            $validated['photo_docente'] = $fileName;
        }

        ModelDocente::create($validated);

        return redirect()->route('docentes.index')->with('success', 'Docente criado com sucesso!');
    }
    
}
