<?php

namespace App\Http\Controllers;

use App\Models\Semester;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::all();
        return view('semesters.index', compact('semesters'));
    }

    public function show($id)
    {
        $semester = Semester::with('students')->findOrFail($id);
        return view('semesters.show', compact('semester'));
    }

    // Add more methods for create, store, edit, update, destroy
}
