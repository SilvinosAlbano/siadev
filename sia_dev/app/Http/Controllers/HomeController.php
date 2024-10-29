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
            DB::raw("SUM(selu_total) as total_earning")
        )
        ->where('payment_status', 'Paid')
        ->groupBy(DB::raw("EXTRACT(YEAR FROM data_selu)"))
        ->orderBy('year')
        ->get();



        $genderData = DB::table('students')
        ->select(DB::raw('gender, COUNT(*) as count'))
        ->groupBy('gender')
        ->pluck('count', 'gender')
        ->toArray();

        $countdocentelevel = DB::table('view_docente')
        ->select('tipo_contrato', DB::raw('COUNT(*) as count'))
        ->groupBy('tipo_contrato')
        ->pluck('count', 'tipo_contrato')
        ->toArray();
    

        $countDepartamento = DB::table('students as a')
    ->join('matricula as b', 'b.id_student', '=', 'a.id_student')
    ->join('programa_estudo as c', 'c.id_programa_estudo', '=', 'b.id_programa_estudo')
    ->join('departamento as d', 'd.id_departamento', '=', 'c.id_departamento')
    ->select('d.nome_departamento', DB::raw('COUNT(a.id_student) as count'))
    ->groupBy('d.nome_departamento')
    ->pluck('count', 'nome_departamento')
    ->toArray();



    //     $alerta = DB::select("
    //     WITH payment_summary AS (
    //         SELECT 
    //             a_1.id_student,
    //             a_1.id_semestre,
    //             SUM(a_1.selu_total) AS total_paid,
    //             b_1.total_indice AS total_required
    //         FROM pagamento_estudante a_1
    //         LEFT JOIN controlo_departamento_pagamento b_1 ON b_1.id_controlo_departamento = a_1.id_controlo_departamento
    //         GROUP BY a_1.id_student, a_1.id_semestre, b_1.total_indice
    //     )
    //     SELECT 
    //         e.nome_departamento,
    //         c.numero_semestre,
    //         COUNT(DISTINCT d.id_student) AS total_unpaid_students
    //     FROM pagamento_estudante a
    //     LEFT JOIN controlo_departamento_pagamento b ON b.id_controlo_departamento = a.id_controlo_departamento
    //     LEFT JOIN semestre c ON c.id_semestre = a.id_semestre
    //     LEFT JOIN students d ON d.id_student = a.id_student
    //     LEFT JOIN departamento e ON e.id_departamento = b.id_departamento
    //     LEFT JOIN payment_summary ps ON ps.id_student = a.id_student AND ps.id_semestre = a.id_semestre
    //     WHERE 
    //         (ps.total_paid < ps.total_required::numeric OR ps.total_paid IS NULL) -- Unpaid status
    //     GROUP BY 
    //         e.nome_departamento,
    //         c.numero_semestre
    //     ORDER BY 
    //         e.nome_departamento,
    //         c.numero_semestre
    // ");
    
        return view('pages.home', compact('totalFuncionario','totalEstudante','data','genderData','countDepartamento','countdocentelevel'));
    }
}
