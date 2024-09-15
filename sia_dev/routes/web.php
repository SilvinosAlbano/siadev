<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\DivisaoAdministrativaController;
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
Route::middleware('check.access')->group(function () {
    // Public Routes
    Route::get('/', function () {
        return view('pages.home');
    });
    Route::get('/home', function () {
        return view('pages.home');
    });

    // Students Routes
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id_student}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{id_student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id_student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{id_student}', [StudentController::class, 'destroy'])->name('students.destroy');


    // Existing routes for users and roles management
    Route::get('/all_users', [UserController::class, 'index'])->name('users.index');
    Route::get('user_details/{user}',  [UserController::class, 'show'])->name('users.show');
    Route::get('/assign_roles/{user}', [UserRoleController::class, 'assignRolesForm'])->name('assign.roles.form');
    Route::post('/assign_roles/{user}', [UserRoleController::class, 'assignRoles'])->name('assign.roles');


    // route for teachers
    // Route for Menus of Teachers
    Route::get('/docentes', [DocenteController::class, 'index'])->name('docentes.index');
    Route::get('/detailho/{id}', [DocenteController::class, 'showDetail'])->name('detailho');
    Route::get('/habilitacao/{id}', [DocenteController::class, 'showHabilitacoes'])->name('habilitacao_funcionario');
    Route::get('/funcionario/horario/{id}', [DocenteController::class, 'horario'])->name('horario');
    Route::get('/funcionario/inserir_habilitacao/{id_funcionario}', [DocenteController::class, 'create_habilitacao'])->name('inserir_habilitacao');
    Route::post('/funcionario/habilitacao/store', [DocenteController::class, 'storeHabilitacao'])->name('store_habilitacao');

    Route::get('/alterar_habilitacao/{id}', [DocenteController::class, 'editHabilitacao'])->name('alterar_habilitacao.index'); // Handle the update request

    Route::delete('/habilitacao/{id}', [DocenteController::class, 'destroyHabilitacao'])->name('destroy_habilitacao');

    Route::put('/update_habilitacao/{id}', [DocenteController::class, 'updateHabilitacao'])->name('habilitacao.update');
    #estatuto
    Route::get('/funcionario/estatuto/{id}', [DocenteController::class, 'estatuto'])->name('estatuto');
    Route::get('/funcionario/inserir_estatuto/{id_funcionario}', [DocenteController::class, 'create_estatuto'])->name('inserir_estatuto');
    Route::post('/funcionario/estatuto/store', [DocenteController::class, 'storeEstatuto'])->name('store_estatuto');
    Route::get('/alterar_estatuto/{id}', [DocenteController::class, 'editEstatuto'])->name('alterar_estatuto.index'); // Handle the update request
    Route::put('/update_estatuto/{id}', [DocenteController::class, 'updateEstatuto'])->name('estatuto.update');
    Route::delete('/estatuto/{id}', [DocenteController::class, 'destroyEstatuto'])->name('estatuto.destroy');

    #end
    Route::get('/adiciona_docente', [DocenteController::class, 'formDocente'])->name('adiciona_docente.index');
    Route::post('/docentes/store', [DocenteController::class, 'store'])->name('docentes.store');

    Route::get('/docentes/data', [DocenteController::class, 'getDocentesData'])->name('docentes.data');
    Route::get('/editar/{id}', [DocenteController::class, 'edit'])->name('editar');
    Route::put('/docentes/{id_docente}', [DocenteController::class, 'update'])->name('docentes.update');
    Route::delete('/docentes/{id}', [DocenteController::class, 'destroy'])->name('docentes.destroy');

    Route::put('/docentes/restore/{id}', [DocenteController::class, 'restore'])->name('docentes.restore');
    Route::get('/docente-report', [DocenteController::class, 'report'])->name('docentes.report');
    Route::get('/docente-export', [DocenteController::class, 'export'])->name('docentes.export');
    #end

    // routes/web.php
    Route::get('/get-postos/{idMunicipio}', [DivisaoAdministrativaController::class, 'getPostos']);
    Route::get('/get-sucos/{idPosto}', [DivisaoAdministrativaController::class, 'getSucos']);
    Route::get('/get-aldeias/{idSuco}', [DivisaoAdministrativaController::class, 'getAldeias']);
});
