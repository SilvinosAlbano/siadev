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


       
       $data = DB::table('view_pagamento_estudante')
        ->select(
            DB::raw("EXTRACT(YEAR FROM data_selu) as year"),
            DB::raw("SUM(total_paid) as total_earning")
        )
        ->where('payment_status', 'Paid')
        ->groupBy(DB::raw("EXTRACT(YEAR FROM data_selu)"))
        ->orderBy('year')
        ->get();
    
        return view('pages.home', compact('totalFuncionario','totalEstudante','data'));
    }
}
