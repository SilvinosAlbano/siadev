<?php

namespace App\Http\Controllers;

use App\Models\ModelDepartamento;
use App\Models\ModelStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DisciplinasDepartamentoController extends Controller
{
    // Display a listing of the departamentos
    public function index()
    {
        $departamentos = ModelDepartamento::with('faculdade')->get();
        return view('departamento.index', compact('departamentos'));
    }

    public function Departamentoestudante($id_estudent)
    {
        $student = ModelStudent::findOrFail($id_estudent);
        $departamentos = DB::table('view_programa_estudo_estudante')
            ->where('id_student', $id_estudent)
            ->paginate(10);
        $estudanteDepartamento = DB::select("
        SELECT 
            a.id_departamento_estudante,
            a.id_student,
            c.id_faculdade,
            c.nome_faculdade,
            b.id_departamento,
            a.controlo_estado,
            b.nome_departamento
        FROM estudante_departamento a
        LEFT JOIN departamento b ON b.id_departamento = a.id_departamento
        LEFT JOIN faculdade c ON c.id_faculdade = b.id_faculdade
        WHERE a.id_student = ?
    ", [$id_estudent]);

        return view('departamento.index', compact('departamentos'));
    }

    // Show the form for creating a new departamento
    public function create()
    {
        return view('departamento.create');
    }

    // Store a newly created departamento in the database
    public function store(Request $request)
    {
        $request->validate([
            'nome_departamento' => 'required|string|max:255',
            'id_faculdade' => 'required|uuid|exists:faculdades,id_faculdade',
        ]);

        ModelDepartamento::create([
            'id_departamento' => Str::uuid(), // Generate a new UUID
            'nome_departamento' => $request->nome_departamento,
            'id_faculdade' => $request->id_faculdade,
        ]);

        return redirect()->route('departamentos.index')->with('success', 'Departamento created successfully!');
    }

    // Display the specified departamento
    public function show($id)
    {
        $departamento = ModelDepartamento::with('faculdade')->findOrFail($id);
        return view('departamento.show', compact('departamento'));
    }

    // Show the form for editing the specified departamento
    public function edit($id)
    {
        $departamento = ModelDepartamento::findOrFail($id);
        return view('departamento.edit', compact('departamento'));
    }

    // Update the specified departamento in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_departamento' => 'required|string|max:255',
            'id_faculdade' => 'required|uuid|exists:faculdades,id_faculdade',
        ]);

        $departamento = ModelDepartamento::findOrFail($id);
        $departamento->update($request->only(['nome_departamento', 'id_faculdade']));

        return redirect()->route('departamentos.index')->with('success', 'Departamento updated successfully!');
    }

    // Remove the specified departamento from the database
    public function destroy($id)
    {
        $departamento = ModelDepartamento::findOrFail($id);
        $departamento->delete();

        return redirect()->route('departamentos.index')->with('success', 'Departamento deleted successfully!');
    }
}
