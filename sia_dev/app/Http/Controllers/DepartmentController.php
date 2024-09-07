<?php

namespace App\Http\Controllers;

use App\Models\ModelDepartamento;

class DepartmentController extends Controller
{
    public function index()
    {
        $modelDepartamentos= ModelDepartamento::all();
        return view('departamento.index', compact('modelDepartamentos'));
    }

    public function show($id)
    {
        $modelDepartamentos = ModelDepartamento::find($id);

        if (!$modelDepartamentos) {
            abort(404, 'Department not found');
        }

        return view('departamento.show', compact('modelDepartamentos'));
    }
}
