<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization as needed
    }

    public function rules()
    {
        return [
            'complete_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'nre' => 'nullable|string|max:50',
            'faculty' => 'nullable|string|max:255',
            'department' => 'required|string|in:Enfermagem,Medicina Geral',
            'semester' => 'required|string|in:Semestre I,Semestre II,Semestre III',
            'start_year' => 'nullable|integer|min:2000',
            'student_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'observation' => 'nullable|string|max:1000',
        ];
    }
}
