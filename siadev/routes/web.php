<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});


Route::get('/home', function () {
    return view('pages.home');
});

// Menus for Students
// Route::get('/all_students', function () {
//     return view('pages.students.all_students');
// });


// Route::get('/student_details/{id}', function () {
//     return view('pages.students.student_details');
// });


Route::get('/all_students', [StudentController::class, 'index'])->name('students.index');

Route::get('/student_details/{student_id}', [StudentController::class, 'show'])->name('students.show');

Route::get('/student_promotion', function () {
    return view('pages.students.student_promotion');
});
Route::get('/admission_form_student', function () {
    return view('pages.students.admission_form_student');
});

// CRUD for  Students
// Route to display the form (GET request)
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

// Route to handle form submission (POST request)
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

// Route for Menus of Teachers
Route::get('/all_teachers', function () {
    return view('pages.teachers.all_teachers');
});
Route::get('/teacher_details', function () {
    return view('pages.teachers.teacher_details');
});
Route::get('/teacher_payment', function () {
    return view('pages.teachers.teacher_payment');
});
Route::get('/add_teacher', function () {
    return view('pages.teachers.add_teacher');
});

// Route for Menus for Classes
Route::get('/all_classes', function () {
    return view('pages.classes.all_classes');
});
Route::get('/add_classes', function () {
    return view('pages.classes.add_classes');
});
Route::get('/class_routine', function () {
    return view('pages.classes.class_routine');
});



// Route for Menus of Subjects
Route::get('/all_subject', function () {
    return view('pages.subjects.all_subject');
});


// Route Menus of Attendences
Route::get('/student_attendence', function () {
    return view('pages.attendences.student_attendence');
});
