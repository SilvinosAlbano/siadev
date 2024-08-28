<?php

namespace App\Http\Controllers;

use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function show($id)
    {
        $department = Department::with('students')->findOrFail($id);
        return view('departments.show', compact('department'));
    }

    // Add more methods for create, store, edit, update, destroy
}
