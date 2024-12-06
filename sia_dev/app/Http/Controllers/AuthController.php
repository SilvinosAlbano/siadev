<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use \Illuminate\Foundation\Auth\User;
use Yajra\DataTables\DataTables;
use App\Models\ModelStudent;
use App\Models\ModelSemestre;
use App\Models\ModelDepartamento;
use App\Models\ModelMatricula;
use App\Models\ModelProgramaEstudo;
use Illuminate\Support\Facades\Storage;
use App\Models\ModelUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;
use App\Models\ModelPagamentoStudante;
use App\Exports\PaymentsExport;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        }

        return redirect()->back()->withErrors(['username' => 'Invalid credentials']);
    }

    /*  public function login(Request $request)
    {
        // Validate the login credentials
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:6',
        ]);

        // Extract the credentials from the request
        $credentials = $request->only('username', 'password');

        // Attempt to find the user based on the username
        $user = User::where('username', $credentials['username'])->first();

        // Check if the user exists and passwords match
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Log the user in
            Auth::login($user);

            // Check if the user is a student and has a valid docente_id_student
            if ($user->tipo_usuario == 'Estudante' && $user->docente_id_student) {
                // Carregar o estudante com dados relacionados
                $student = ModelStudent::with(['matriculas.semestre', 'matriculas.programaEstudo.departamento'])->findOrFail($user->docente_id_student);

                // Obter todos os departamentos e semestres disponíveis
                $modelDepartamentos = ModelDepartamento::all();
                $semesters = ModelSemestre::all();

                // Passar o estudante, departamentos e semestres para a view
                return view('pages.students.student_details', compact('student', 'modelDepartamentos', 'semesters'));
            }

            // Default redirect for non-student users
            return redirect()->intended('/home');
        }

        // Return an error if credentials don't match
        return redirect()->back()->withErrors(['username' => 'Invalid credentials']);
    }
 */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
