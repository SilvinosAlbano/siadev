<?php

namespace App\Http\Controllers;

use App\Models\ModelMateria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{
   public function index()
    {
        
        $materia= ModelMateria::all();
        return view('pages.disciplinas.materia_disciplinas', compact('materia'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'materia' => 'required|string|max:250',
            'codigo_materia' => 'required|string|max:50',
            'credito' => 'required|string|max:250',
        ]);
    
       ModelMateria::create([
            'materia' => $request->materia,
            'codigo_materia' => $request->codigo_materia,
            'credito' => $request->credito,
        ]);
    
        return redirect()->back()->with('success', 'Subject added successfully!');
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'materia' => 'required|string|max:250',
            'codigo_materia' => 'required|string|max:50',
            'credito' => 'required|string|max:250',
        ]);
    
        $materia = ModelMateria::findOrFail($id);
        $materia->update([
            'materia' => $request->materia,
            'codigo_materia' => $request->codigo_materia,
            'credito' => $request->credito,
        ]);
    
        return redirect()->back()->with('success', 'Subject updated successfully!');
    }
    



    public function edit($id)
    {
        $materia= ModelMateria::all();
        $mat = ModelMateria::findOrFail($id); // Fetch the specific record
        return view('pages.disciplinas.materia_disciplinas', compact('mat','materia')); // Return the form view with the fetched data
    }
    

public function destroy($id)
{
    // Check if the record exists before attempting deletion
    $materia = DB::table('materia')->where('id_materia', $id)->first();

    if ($materia) {
        // Perform the delete action
        DB::table('materia')->where('id_materia', $id)->delete();

        return redirect()->back()->with('success', 'Materia Disciplina apaga com sucesso.');
    } else {
        return redirect()->back()->with('error', 'Materia not found.');
    }
}




}
