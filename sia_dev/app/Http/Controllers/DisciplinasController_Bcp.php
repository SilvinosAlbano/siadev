<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\ModelMateria;
use App\Models\ModelMateriaSemestre;
use App\Models\ModelSemestre;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DisciplinasController_Bcp extends Controller
{


    public function index()
    {
        $semesters = ModelSemestre::all();
        return view('pages.disciplinas.materia_disciplinas', compact('semesters'));
    }

    public function disciplina_departamentos()
    {
        return view('pages.disciplinas.departamentos.departamentos');
    }

    public function disciplina_programas()
    {
        return view('pages.disciplinas.programas.programas');
    }

    public function disciplina_semestres()
    {
        return view('pages.disciplinas.semestres.semestres');
    }

    public function disciplina_disciplinas()
    {
        return view('pages.disciplinas.disciplinas.disciplinas');
    }

    public function getMateria(Request $request)
    {
        if ($request->ajax()) {
            $data = ModelMateria::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
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

        ]);

        ModelMateria::create([
            'materia' => $request->materia,
            'codigo_materia' => $request->codigo_materia,

        ]);

        return redirect()->back()->with('success', 'Subject added successfully!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'materia' => 'required|string|max:250',
            'codigo_materia' => 'required|string|max:50',

        ]);

        $materia = ModelMateria::findOrFail($id);
        $materia->update([
            'materia' => $request->materia,
            'codigo_materia' => $request->codigo_materia,

        ]);

        return redirect()->back()->with('success', 'Subject updated successfully!');
    }




    public function edit($id)
    {
        $materia = ModelMateria::all();
        $mat = ModelMateria::findOrFail($id); // Fetch the specific record
        return view('pages.disciplinas.materia_disciplinas', compact('mat', 'materia')); // Return the form view with the fetched data
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


    // materia semester

    public function showMateriaSemestre()
    {
        $departamento = DB::table('departamento')->paginate(10);
        $semestre = DB::table('semestre')->paginate(10);
        $materia = ModelMateria::all();
        return view('pages.disciplinas.materia_semestre', compact('materia', 'departamento', 'semestre'));
    }

    public function storeMateriaSemestre(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'credito' => 'required|array',
            'credito.*' => 'nullable|numeric', // Allow nullable credits for unchecked items
            'id_departamento' => 'required|exists:departamento,id_departamento',
            'id_semestre' => 'required|exists:semestre,id_semestre',
            'materia_ids' => 'required|array',
            'materia_ids.*' => 'exists:materia,id_materia',
        ]);

        // Loop through each selected materia ID
        foreach ($request->input('materia_ids') as $materiaId) {
            // Check if a credito value exists for this materia ID and is valid
            $credito = $request->input('credito')[$materiaId] ?? null;

            if ($credito !== null) { // Only process if credito is provided
                DB::table('materia_semestre')->insert([
                    'id_materia' => $materiaId,
                    'credito' => $credito,
                    'id_departamento' => $request->input('id_departamento'),
                    'id_semestre' => $request->input('id_semestre'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Redirect back or to a specific route with success message
        return redirect()->route('materia_semestre.index')->with('success', 'Dados materia Semestre gravado com sucesso😍!');
    }



    public function updateMateriaSemestre(Request $request, $id)
    {
        // Validate form inputs
        $request->validate([
            'credito' => 'required|numeric',
            'id_departamento' => 'required|exists:departamento,id_departamento',
            'id_semestre' => 'required|exists:semestre,id_semestre',
        ]);

        // Find the existing materia record by ID
        $materia = ModelMateria::findOrFail($id);

        // Update the values
        $materia->credito = $request->input('credito');
        $materia->id_departamento = $request->input('id_departamento');
        $materia->id_semestre = $request->input('id_semestre');

        // Save to the database
        $materia->save();

        // Redirect back with success message
        return redirect()->route('materia_semestre.index')->with('success', 'Materia updated successfully');
    }


    // public function getMateriaSemestre(Request $request)
    // {
    //     if ($request->ajax()) {
    //         // $data = ModelMateria::select('*');
    //         $data = DB::table('view_materia_semestre')->select('*');    
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 // $editUrl = route('materia.edit', $row->id_materia);

    //                 $btn = '';
    //                 $btn .= ' <form action="' . route('materia_semestre.destroy', $row->id_materia_semestre) . '" method="POST" style="display:inline;">
    //                             ' . csrf_field() . '
    //                             ' . method_field('DELETE') . '
    //                             <button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza de apagar este dados😢?\')">Apagar</button>
    //                           </form>';

    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    public function getMateriaSemestre(Request $request)
    {
        if ($request->ajax()) {
            // Retrieve the semester filter from the request
            $numeroSemestre = $request->input('numero_semestre');

            // Query data from the view
            $query = DB::table('view_materia_semestre')->select('*');

            // Apply the semester filter if it exists
            if ($numeroSemestre) {
                $query->where('numero_semestre', $numeroSemestre);
                // Calculate the sum of credito only if a specific semester is selected
                $totalCredito = $query->sum('credito');
            } else {
                // Set totalCredito to 0 if no specific semester is selected
                $totalCredito = 0;
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= ' <form action="' . route('materia_semestre.destroy', $row->id_materia_semestre) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="delete btn btn-danger btn-sm" onclick="return confirm(\'Tem certeza de apagar este dados😢?\')">Apagar</button>
                          </form>';

                    return $btn;
                })
                ->with('totalCredito', $totalCredito) // Include totalCredito in the response
                ->rawColumns(['action'])
                ->make(true);
        }
    }



    public function destroymateriasemestre($id)
    {
        // Check if the record exists before attempting deletion
        $materia = DB::table('materia_semestre')->where('id_materia_semestre', $id)->first();

        if ($materia) {
            // Perform the delete action
            DB::table('materia_semestre')->where('id_materia_semestre', $id)->delete();

            return redirect()->back()->with('success', 'Dados apaga com sucesso ✔.');
        } else {
            return redirect()->back()->with('error', 'Materia not found.');
        }
    }
}
