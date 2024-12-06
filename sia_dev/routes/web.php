<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\DivisaoAdministrativaController;
use App\Http\Controllers\DisciplinasController;
use App\Http\Controllers\DisciplinasDepartamentoController;
use App\Http\Controllers\DisciplinasDisciplinaController;
use App\Http\Controllers\salasController;
use App\Http\Controllers\Datascontroller;
use App\Http\Controllers\HomeController;

// routes/web.php
// routes/web.php
Route::get('/unauthorized', function () {
    return view('unauthorized');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Password reset routes (optional, if you have a password reset functionality)
Route::get('password/request', [AuthController::class, 'showPasswordRequestForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');

// Example route for admin users
// Route::group(['middleware' => ['auth', 'role:admin']], function () {

// Route::get('/students/{id_student}/edit', [StudentController::class, 'edit'])->name('students.edit');

Route::middleware('check.access')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Students Routes
    Route::resource('students', StudentController::class);

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id_student}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{id_student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id_student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{id_student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('/lista_pagamento_estudante', [StudentController::class, 'listaPagamento'])->name('lista_pagamento_estudante');
    Route::get('/get-payment-student', [StudentController::class, 'getPaymentStudent'])->name('get.payment_student');
    #start materia estudante
    Route::get('/estudante/materia/{id}', [StudentController::class, 'MateriaEstudante'])->name('materia_estudante');
    #end

    #start Departamento estudante
    Route::get('/estudante/departamento/{id}', [StudentController::class, 'DepartamentoEstudante'])->name('departamento_estudante');
    #end

    #start Matricula estudante
    Route::get('/estudante/matricula/{id}', [StudentController::class, 'MatriculaEstudante'])->name('matricula_estudante');
    #end

    #start pagamento estudante
    Route::get('/estudante/pagamento/{id}', [StudentController::class, 'PagamentoEstudante'])->name('pagamento_estudante');
    Route::get('/estudante/inserir_pagamento/{id_student}', [StudentController::class, 'create_pagamento'])->name('inserir_pagamento');
    Route::post('/pagamento_store', [StudentController::class, 'Pagamentostore'])->name('pagamento.store');

    Route::get('export-payments', [StudentController::class, 'exportPayments'])->name('export.payments');

    Route::get('export-payments-csv', [StudentController::class, 'exportPaymentscsv'])->name('export.payments.csv');
    #end

    #programa estudo start
    Route::get('/estudante/programa_estudo/{id}', [StudentController::class, 'ProgramaEstudo'])->name('programa_estudo');


    Route::post('/import-excel', [StudentController::class, 'import_excel_post'])->name('import-excel');

    // end student

    // Existing routes for users and roles management
    Route::get('/all_users', [UserController::class, 'index'])->name('users.index');
    Route::get('user_details/{user}',  [UserController::class, 'show'])->name('users.show');
    Route::get('/assign_roles/{user}', [UserRoleController::class, 'assignRolesForm'])->name('assign.roles.form');
    Route::post('/assign_roles/{user}', [UserRoleController::class, 'assignRoles'])->name('assign.roles');


    // route for teachers
    // Route for Menus of Teachers
    Route::get('/escolha_dados_docentes', [DocenteController::class, 'escolhaDados'])->name('escolha');
    Route::get('/detailho_escolha/{id}', [DocenteController::class, 'showDetailEscolha'])->name('detailho_escolha');
    Route::post('/import-excel-funcionario', [DocenteController::class, 'import_excel_post'])->name('import-excel-funcionario');
    Route::get('/funcionarios', [DocenteController::class, 'index'])->name('funcionarios.index');
    Route::get('get-docentes', [DocenteController::class, 'getDocentesdepartamento'])->name('get.docentesdepartamento');



    Route::get('/detailho/{id}', [DocenteController::class, 'showDetail'])->name('detailho');
    Route::get('/habilitacao/{id}', [DocenteController::class, 'showHabilitacoes'])->name('habilitacao_funcionario');
    Route::get('/funcionario/horario/{id}', [DocenteController::class, 'horario'])->name('horario');
    Route::get('/funcionario/inserir_habilitacao/{id_funcionario}', [DocenteController::class, 'create_habilitacao'])->name('inserir_habilitacao');
    Route::post('/funcionario/habilitacao/store', [DocenteController::class, 'storeHabilitacao'])->name('store_habilitacao');

    Route::get('/alterar_habilitacao/{id}', [DocenteController::class, 'editHabilitacao'])->name('alterar_habilitacao.index'); // Handle the update request

    Route::delete('/habilitacao/{id}', [DocenteController::class, 'destroyHabilitacao'])->name('destroy_habilitacao');

    Route::put('/update_habilitacao/{id}', [DocenteController::class, 'updateHabilitacao'])->name('habilitacao.update');

    Route::get('get-funcionario', [DocenteController::class, 'getFuncionario'])->name('get.funcionario');
    Route::get('get-funcionario-report', [DocenteController::class, 'getFuncionarioReport'])->name('get.funcionario.report');
    Route::get('/funcionarios/export-pdf', [DocenteController::class, 'exportPDF'])->name('funcionarios.export.pdf');


    #estatuto
    Route::get('/funcionario/estatuto/{id}', [DocenteController::class, 'estatuto'])->name('estatuto');
    Route::get('/funcionario/inserir_estatuto/{id_funcionario}', [DocenteController::class, 'create_estatuto'])->name('inserir_estatuto');
    Route::post('/funcionario/estatuto/store', [DocenteController::class, 'storeEstatuto'])->name('store_estatuto');
    Route::get('/alterar_estatuto/{id}', [DocenteController::class, 'editEstatuto'])->name('alterar_estatuto.index'); // Handle the update request
    Route::put('/update_estatuto/{id}', [DocenteController::class, 'updateEstatuto'])->name('estatuto.update');
    Route::delete('/estatuto/{id}', [DocenteController::class, 'destroyEstatuto'])->name('estatuto.destroy');
    #end


    #departamento
    Route::get('/funcionario/departamento/{id}', [DocenteController::class, 'showDepartamento'])->name('departamento');
    Route::get('/funcionario/inserir_departamento/{id_funcionario}', [DocenteController::class, 'create_departamento'])->name('inserir_departamento');
    Route::post('/funcionario/departamento/store', [DocenteController::class, 'storeDepartamento'])->name('store_departamento');
    Route::get('/alterar_departamento/{id}', [DocenteController::class, 'editDepartamento'])->name('alterar_departamento.index'); // Handle the update request
    Route::put('/update_departamento/{id}', [DocenteController::class, 'updateDepartamento'])->name('departamento.update');
    Route::delete('/departamento/{id}', [DocenteController::class, 'destroyDepartamento'])->name('departamento.destroy');
    #end
    //#materia docente
    Route::get('/funcionario/materia/{id}', [DocenteController::class, 'showMateria'])->name('materia_docente');
    Route::get('/funcionario/inserir_materia_docente/{id_funcionario}', [DocenteController::class, 'create_materiaDocente'])->name('inserir_materia_docente');
    Route::post('/funcionario/docentemateria/store', [DocenteController::class, 'storeDocenteMateria'])->name('store_docentemateria');
    Route::get('/alterar_docentemateria/{id}', [DocenteController::class, 'editDocentemateria'])->name('alterar_docentemateria');
    Route::put('/update_docentemateria/{id}', [DocenteController::class, 'updateDocentemateria'])->name('update_docentemateria.update');
    Route::delete('/docentemateria/{id}', [DocenteController::class, 'destroyDocentemateria'])->name('docentemateria.destroy');
    #end
    #posicao funcionario
    Route::get('/funcionario/posicao/{id}', [DocenteController::class, 'showPozisaun'])->name('posicao_funcionario');
    Route::get('/funcionario/inserir_pozisaun/{id_funcionario}', [DocenteController::class, 'createPozisaun'])->name('inserir_materia_pozisaun');
    Route::post('/funcionario/pozisaun/store', [DocenteController::class, 'storePozisaun'])->name('store_pozisaun');
    Route::get('/alterar_posicao/{id}', [DocenteController::class, 'editPozisaun'])->name('alterar_posicao');

    Route::put('/update_pozisaun/{id}', [DocenteController::class, 'update_posicao'])->name('updateposicao');
    Route::delete('/funcionarioposicao/{id}', [DocenteController::class, 'destroyPozisaun'])->name('posicao.destroy');
    #end 
    #create funcionario
    Route::get('/adiciona_funcionario', [DocenteController::class, 'formDocente'])->name('adiciona_funcionario.index');
    Route::post('/docentes/store', [DocenteController::class, 'store'])->name('docentes.store');

    Route::get('/docentes/data', [DocenteController::class, 'getDocentesData'])->name('docentes.data');
    Route::get('/editar/{id}', [DocenteController::class, 'edit'])->name('editar');
    Route::put('/funcionario/{id_funcionario}', [DocenteController::class, 'update'])->name('funcionario.update');
    Route::delete('/docentes/{id}', [DocenteController::class, 'destroy'])->name('docentes.destroy');

    Route::put('/docentes/restore/{id}', [DocenteController::class, 'restore'])->name('docentes.restore');
    Route::get('/docente-report', [DocenteController::class, 'report'])->name('docentes.report');
    Route::get('/docente-export', [DocenteController::class, 'export'])->name('docentes.export');
    #end

    // materia discplina start
    // Route::get('/disciplinas', [DisciplinasController::class, 'index'])->name('disciplinas.index');
    Route::post('/materia/store', [DisciplinasController::class, 'store'])->name('materia.stores');
    Route::put('/materia/update/{id}', [DisciplinasController::class, 'update'])->name('materia.update');
    Route::get('/materia/{id}/edit', [DisciplinasController::class, 'edit'])->name('materia.edit');
    Route::delete('/materia/{id}', [DisciplinasController::class, 'destroy'])->name('materia.destroy');

    Route::get('get-materia', [DisciplinasController::class, 'getMateria'])->name('get.materia');

    Route::get('/materia_semestre', [DisciplinasController::class, 'showMateriaSemestre'])->name('materia_semestre.index');
    Route::post('/materia/store', [DisciplinasController::class, 'storeMateriaSemestre'])->name('materiasemestre.store');
    Route::put('/materia/update/{id}', [DisciplinasController::class, 'updateMateriaSemestre'])->name('materiasemestre.update');
    Route::get('get-materia-semetre', [DisciplinasController::class, 'getMateriaSemestre'])->name('get.materia_semestre');
    Route::delete('/materia/semestre/{id}', [DisciplinasController::class, 'destroyMateriaSemestre'])->name('materia_semestre.destroy');

    // end

    // sala aulas start
    Route::get('/salas', [SalasController::class, 'index'])->name('sala.index');
    Route::post('/salas/store', [SalasController::class, 'store'])->name('salas.store');
    Route::put('/salas/update/{id}', [SalasController::class, 'update'])->name('salas.update');
    Route::get('/salas/{id}/edit', [SalasController::class, 'edit'])->name('salas.edit');
    Route::delete('/salas/{id}', [SalasController::class, 'destroy'])->name('salas.destroy');
    #end
    // start datas
    Route::get('/datas', [DatasController::class, 'index'])->name('data.index');
    Route::post('/datas/store', [DatasController::class, 'store'])->name('datas.store');
    Route::put('/datas/update/{id}', [DatasController::class, 'update'])->name('datas.update');
    Route::get('/datas/{id}/edit', [DatasController::class, 'edit'])->name('datas.edit');
    Route::delete('/datas/{id}', [DatasController::class, 'destroy'])->name('datas.destroy');
    #end
    // routes/web.php
    Route::get('/get-postos/{idMunicipio}', [DivisaoAdministrativaController::class, 'getPostos']);
    Route::get('/get-sucos/{idPosto}', [DivisaoAdministrativaController::class, 'getSucos']);
    Route::get('/get-aldeias/{idSuco}', [DivisaoAdministrativaController::class, 'getAldeias']);



    // Web routes for Disciplinas
    Route::get('disciplinas_index', [DisciplinasController::class, 'index'])->name('disciplinas_index.index');
    Route::get('/disciplina_departamentos', [DisciplinasController::class, 'disciplina_departamentos'])->name('disciplinas.departamentos');
    Route::get('/disciplina_programas', [DisciplinasController::class, 'disciplina_programas'])->name('disciplinas.programas');
    Route::get('/disciplina_semestres', [DisciplinasController::class, 'disciplina_semestres'])->name('disciplinas.semestres');
    // Route::get('/disciplina_disciplinas', [DisciplinasController::class, 'disciplina_semestres'])->name('disciplinas.disciplinas');
    // Route::get('/disciplina_disciplinas', [DisciplinasDisciplinaController::class, 'index'])->name('disciplinas.disciplinas');

    Route::prefix('disciplinas')->group(function () {
        Route::get('/disciplina_disciplinas', [DisciplinasDisciplinaController::class, 'index'])->name('disciplinas.disciplinas');
        Route::post('/store', [DisciplinasDisciplinaController::class, 'store'])->name('disciplinas.disciplinas.store');
        Route::put('/{id}', [DisciplinasDisciplinaController::class, 'update'])->name('disciplinas.disciplinas.update');
        Route::delete('/{id}', [DisciplinasDisciplinaController::class, 'destroy'])->name('disciplinas.disciplinas.destroy');
    });
});
