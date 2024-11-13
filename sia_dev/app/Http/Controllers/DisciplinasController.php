<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\ModelMateria;
use App\Models\ModelDepartamento;
use App\Models\ModelFaculdade;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DisciplinasController extends Controller
{


    public function index()
    {
        // This could load disciplines or a general page
        return view('pages.disciplinas.silabos_materias');
    }

    // In DisciplinasController.php
    public function disciplina_departamentos()
    {
        // Fetching departments with their associated faculty (eager loading)
        $departamentos = ModelDepartamento::with('faculdade')->get();
        return view('pages.disciplinas.departamentos.departamentos', compact('departamentos'));
    }

    public function disciplina_disciplinas()
    {
        $disciplinas = ModelMateria::all();
        return view('pages.disciplinas.disciplinas.disciplinas', compact('disciplinas'));
    }



    public function disciplina_programas()
    {
        return view('pages.disciplinas.programas.programas');
    }

    public function disciplina_semestres()
    {
        return view('pages.disciplinas.semestres.semestres');
    }
}
