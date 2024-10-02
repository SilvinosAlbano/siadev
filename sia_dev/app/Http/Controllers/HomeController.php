<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalFuncionario = DB::table('funcionario')
        ->whereNull('controlo_estado')
        ->count('id_funcionario');
        $totalEstudante = DB::table('students')
        ->whereNull('controlo_estado')
        ->count('id_student');

        return view('pages.home', compact('totalFuncionario','totalEstudante'));
    }
}
