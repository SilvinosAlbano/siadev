<?php

namespace App\Http\Controllers;

use App\Models\ModelMateria;  // Assuming the model is named ModelMateria
use Illuminate\Http\Request;

class Disciplinas_DisciplinasController extends Controller
{
    public function index()
    {
        $disciplinas = ModelMateria::all();
        return view('pages.disciplinas.silabos_materias', compact('disciplinas'));
    }


    // Show the create form for a new Disciplina
    public function create()
    {
        return view('pages.disciplinas.disciplinas.create');
    }

    // Store a new Disciplina
    public function store(Request $request)
    {
        $request->validate([
            'nome_disciplina' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        // Store the new disciplina
        ModelMateria::create([
            'materia' => $request->nome_disciplina,
            'descricao' => $request->descricao,
            'codigo_materia' => 'some_code', // Example static value
            'credito' => 3, // Example static value
        ]);

        // Redirect with success message
        return redirect()->route('disciplinas.index')->with('success', 'Disciplina criada com sucesso!');
    }

    // Show the edit form for a specific Disciplina
    public function edit(ModelMateria $disciplina)
    {
        return view('pages.disciplinas.disciplinas.edit', compact('disciplina'));
    }


    // Update a specific Disciplina
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_disciplina' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $disciplina = ModelMateria::findOrFail($id);
        $disciplina->update([
            'materia' => $request->nome_disciplina,
            'descricao' => $request->descricao,
        ]);

        // Redirect with success message
        return redirect()->route('disciplinas.index')->with('success', 'Disciplina atualizada com sucesso!');
    }


    public function showDepartamento($id)
    {
        $detail = DB::table('view_monitoramento_funcionario')
            ->where('id_funcionario', $id)
            ->orderByDesc('created_at')
            ->first();

        $depfun = DB::table('departamento_funcionario as a')
            ->leftJoin('departamento as b', 'b.id_departamento', '=', 'a.id_departamento')
            ->leftJoin('faculdade as c', 'c.id_faculdade', '=', 'a.id_faculdade')
            ->leftJoin('funcionario as d', 'd.id_funcionario', '=', 'a.id_funcionario')
            ->select(
                'a.id_departamento_funcionario',
                'b.id_departamento',
                'b.nome_departamento',
                'c.id_faculdade',
                'c.nome_faculdade',
                'd.id_funcionario',
                'd.nome_funcionario',
                'a.data_inicio',
                'a.data_fim',
                'a.controlo_estado'
            )
            ->where('d.id_funcionario', $id)
            ->whereNull('a.controlo_estado')
            ->orderBy('a.data_inicio', 'DESC')
            ->paginate(5);

        return view('pages.disciplinas.departamentos.departamentos', compact('depfun', 'detail'));
    }
    // (Optional) You can also add a destroy method if needed for deleting.
}
