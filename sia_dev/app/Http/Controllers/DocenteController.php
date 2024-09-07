<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\ModelDocente;
use App\Models\ModelDepartamento;
use App\Models\ModelEstatuto;
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
        $departamento = ModelDepartamento::all(); // Assuming you have a Docente model
        $estatuto = ModelEstatuto::all();
        $docente = ModelDocente::paginate(10);
    
        return view('pages.teachers.add_teacher', compact('docente','departamento','estatuto'));
    }

    public function store(Request $request): RedirectResponse
{
    // Validation Rules
    $validated = $request->validate([
        'nome_docente' => 'required|string|max:255',
        'sexo' => 'required|string|max:255',
        'data_moris' => 'required|date',
        'suco' => 'required|string|max:255',
        'id_posto_administrativo' => 'required|string|max:255',
        'id_municipio' => 'required|string|max:255',
        'nacionalidade' => 'nullable|string|max:255',
        'nivel_educacao' => 'nullable|string|max:255',
        'area_especialidade' => 'nullable|string|max:255',
        'universidade_origem' => 'nullable|string|max:255',
        'id_estatuto' => 'required|string|max:255',
        'id_departamento' =>'required|string|max:255',
        'ano_inicio' => 'nullable|date',
        'observacao' => 'nullable|string',
    ]);

    // Handle File Upload if an image is provided
    $photo_docente = null; // Default value if no image is uploaded
    if ($request->hasFile('photo_docente')) {
        $image = $request->file('photo_docente');
        $photo_docente = $image->hashName(); // Generate a unique name for the image
        $image->storeAs('public/asset/posts', $photo_docente); // Store the image
    }

    // Create a new record in the database
    ModelDocente::create([
        'photo_docente' => $photo_docente, // Use the photo name if available, otherwise null
        'nome_docente' => $validated['nome_docente'],
        'sexo' => $validated['sexo'],
        'data_moris' => $validated['data_moris'],
        'suco' => $validated['suco'],
        'id_posto_administrativo' => $validated['id_posto_administrativo'],
        'id_municipio' => $validated['id_municipio'],
        'nacionalidade' => $validated['nacionalidade'],
        'nivel_educacao' => $validated['nivel_educacao'],
        'area_especialidade' => $validated['area_especialidade'],
        'universidade_origem' => $validated['universidade_origem'],
        'id_estatuto' => $validated['id_estatuto'],
        'id_departamento' => $validated['id_departamento'],
        'ano_inicio' => $validated['ano_inicio'],
        'observacao' => $validated['observacao']
    ]);

    // Redirect with Success Message
    return redirect()->route('docentes')->with(['success' => 'Dados com sucesso gravados']);
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
        $docente = ModelDocente::findOrFail($id);
    
        // Validation Rules
        $validated = $request->validate([
            'nome_docente' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'data_moris' => 'required|date',
            'suco' => 'required|string|max:255',
            'id_posto_administrativo' => 'required|string|max:255',
            'id_municipio' => 'required|string|max:255',
            'nacionalidade' => 'nullable|string|max:255',
            'nivel_educacao' => 'nullable|string|max:255',
            'area_especialidade' => 'nullable|string|max:255',
            'universidade_origem' => 'nullable|string|max:255',
            'id_estatuto' => 'required|string|max:255',
            'id_departamento' =>'required|string|max:255',
            'ano_inicio' => 'nullable|date',
            'observacao' => 'nullable|string',
        ]);
    
        // Handle File Upload if a new image is provided
        if ($request->hasFile('photo_docente')) {
            // Delete the old image if it exists
            if ($docente->photo_docente) {
                Storage::delete('public/asset/posts/' . $docente->photo_docente);
            }
    
            // Store the new image
            $image = $request->file('photo_docente');
            $photo_docente = $image->hashName(); // Generate a unique name for the image
            $image->storeAs('public/asset/posts', $photo_docente);
        } else {
            // If no new image, keep the current one
            $photo_docente = $docente->photo_docente;
        }
    
        // Update the existing record in the database
        $docente->update([
            'photo_docente' => $photo_docente, // Use the new photo name if available, otherwise retain the old one
            'nome_docente' => $validated['nome_docente'],
            'sexo' => $validated['sexo'],
            'data_moris' => $validated['data_moris'],
            'suco' => $validated['suco'],
            'id_posto_administrativo' => $validated['id_posto_administrativo'],
            'id_municipio' => $validated['id_municipio'],
            'nacionalidade' => $validated['nacionalidade'],
            'nivel_educacao' => $validated['nivel_educacao'],
            'area_especialidade' => $validated['area_especialidade'],
            'universidade_origem' => $validated['universidade_origem'],
            'id_estatuto' => $validated['id_estatuto'],
            'id_departamento' => $validated['id_departamento'],
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
        return redirect()->route('docentes')->with('success', 'Docente status updated to deleted successfully');
    }

    public function restore($id)
        {
            // Find the docente by its ID
            $docente = ModelDocente::findOrFail($id);
            
            // Set `controlo_estado` back to the default value (e.g., 'active')
            $docente->controlo_estado = 'active';
            $docente->save();
            
            // Redirect with success message
            return redirect()->route('docentes')->with('success', 'Docente restored successfully');
        }


}
