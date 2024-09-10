<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModulePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocenteController;

// routes/web.php
// routes/web.php
Route::get('/unauthorized', function () {
    return view('unauthorized');
});

// Login and Logout routes
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
Route::middleware(['auth'])->group(function () {
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
    Route::get('/students/{student_id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{student_id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student_id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student_id}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Existing routes for users and roles management
    Route::get('/all_users', [UserController::class, 'index'])->name('users.index');
    Route::get('user_details/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users_details/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::post('/assign_role', [ModulePermissionController::class, 'assignRoles'])->name('assign.roles');
    Route::get('/assign_role', [ModulePermissionController::class, 'showAssignRolesForm'])->name('assign.roles.form');



    // Auth::routes();



    // route for teachers
    // Route for Menus of Teachers
    Route::get('/docentes', [DocenteController::class, 'index'])->name('docentes.index');
    Route::get('/detailho/{id}', [DocenteController::class, 'showDetail'])->name('detailho');
    Route::get('/habilitacao_docente/{id}', [DocenteController::class, 'habilitacao'])->name('habilitacao_docente');
    Route::get('/adiciona_docente', [DocenteController::class, 'formDocente'])->name('adiciona_docente.index');
    Route::post('/docentes/store', [DocenteController::class, 'store'])->name('docentes.store');

    Route::get('/docentes/data', [DocenteController::class, 'getDocentesData'])->name('docentes.data');
    Route::get('/editar/{id}', [DocenteController::class, 'edit'])->name('editar');
    Route::put('/docentes/{id_docente}', [DocenteController::class, 'update'])->name('docentes.update');
    Route::delete('/docentes/{id}', [DocenteController::class, 'destroy'])->name('docentes.destroy');

    Route::put('/docentes/restore/{id}', [DocenteController::class, 'restore'])->name('docentes.restore');
    Route::get('/docente-report', [DocenteController::class, 'report'])->name('docentes.report');
    Route::get('/docente-export', [DocenteController::class, 'export'])->name('docentes.export');
});
