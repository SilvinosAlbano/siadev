<?php

namespace App\Http\Controllers;

use App\Models\ModelMateria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DisciplinasDisciplinaController extends Controller
{
    // Display a listing of the disciplinas
    public function index()
    {
        $materias = ModelMateria::all();
        return view('pages.disciplinas.disciplinas.disciplinas', compact('materias'));
    }

    // Show the form for creating a new disciplina
    public function create()
    {
        return view('pages.disciplinas.disciplinas.create');  // This is optional if you are using modals within the same view
    }

    // Store a newly created disciplina in the database
    public function store(Request $request)
    {
        // Validation of form fields
        $request->validate([
            'materia' => 'required|string|max:255',
            'codigo_materia' => 'required|string|unique:materia,codigo_materia',
            'credito' => 'required|integer|min:1',
        ]);

        // Store the new disciplina in the database
        ModelMateria::create([
            'id_materia' => Str::uuid(),
            'materia' => $request->materia,
            'codigo_materia' => $request->codigo_materia,
            'credito' => $request->credito,
        ]);

        // Redirect back with success message
        return redirect()->route('pages.disciplinas.disciplinas.disciplinas.index')->with('success', 'Disciplina created successfully!');
    }

    // Show the form for editing the specified disciplina
    public function edit($id)
    {
        $materia = ModelMateria::findOrFail($id);
        return view('pages.disciplinas.disciplinas.disciplinas.edit', compact('materia'));
    }

    // Update the specified disciplina in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'materia' => 'required|string|max:255',
            'codigo_materia' => 'required|string|unique:materia,codigo_materia,' . $id . ',id_materia',
            'credito' => 'required|integer|min:1',
        ]);

        $materia = ModelMateria::findOrFail($id);
        $materia->update($request->only(['materia', 'codigo_materia', 'credito']));

        return redirect()->route('pages.disciplinas.disciplinas.disciplinas.index')->with('success', 'Disciplina updated successfully!');
    }

    // Remove the specified disciplina from the database
    public function destroy($id)
    {
        $materia = ModelMateria::findOrFail($id);
        $materia->delete();

        return redirect()->route('pages.disciplinas.disciplinas.disciplinas.index')->with('success', 'Disciplina deleted successfully!');
    }
}
