<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\ModelMateria;
use App\Models\ModelMateriaSemestre;
use App\Models\ModelSemestre;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{


    public function index()
    {
        // This could load disciplines or a general page
        return view('pages.disciplinas.silabos_materias');
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
        $disciplinas = ModelMateria::all();
        return view('pages.disciplinas.disciplinas.disciplinas', compact('disciplinas'));
    }

    public function show($disciplina)
    {
        // Retrieve the specific disciplina by its ID or slug
        $disciplina = ModelMateria::findOrFail($disciplina);

        // Return the view with the disciplina data
        return view('disciplinas.show', compact('disciplina'));
    }
}
