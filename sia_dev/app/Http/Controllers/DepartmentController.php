<?php

namespace App\Http\Controllers;

use App\Models\ModelDepartamento;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = ModelDepartamento::all();
        return view('departamento.index', compact('departments'));
    }

    public function show($id)
{
    $department = ModelDepartamento::find($id);

    if (!$department) {
        abort(404, 'Department not found');
    }

    return view('departamento.show', compact('department'));
}


    // Add more methods for create, store, edit, update, destroy
}
