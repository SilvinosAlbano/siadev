<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use App\Models\ModelMateria;
use App\Models\ModelSemestre;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{
//    public function index()
//     {
        
//         $materia= ModelMateria::all();
//         return view('pages.disciplinas.materia_disciplinas', compact('materia'));
//     }

public function index()
{
    $semesters = ModelSemestre::all();
    return view('pages.disciplinas.materia_disciplinas', compact('semesters'));
}

public function getMateria(Request $request)
{
    if ($request->ajax()) {
        $data = ModelMateria::select('*');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $editUrl = route('materia.edit', $row->id_materia);

                $btn = '<a href="' . $editUrl . '" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn .= ' <form action="' . route('materia.destroy', $row->id_materia) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza de apagar este dados?\')">Delete</button>
                          </form>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
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
