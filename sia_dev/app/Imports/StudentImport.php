<?php
namespace App\Imports;

use App\Models\ModelStudent;
use APP\Models\ModelUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class StudentImport implements ToModel
{
    public function model(array $row)
    {
        $gender = $this->validateGender($row[1]);
    
        // Skip the row if gender is null (invalid or missing)
        if (is_null($gender)) {
            return null;
        }
    
        $student = ModelStudent::create([
            'id_student'      => (string) Str::uuid(),
            'complete_name'   => $row[0],
            'gender'          => $gender,
            'place_of_birth'  => $row[2],
            'date_of_birth'   => $this->formatDate($row[3]),
            'nre'             => $row[4],
            'start_year'      => $row[5],
        ]);


        ModelUser::create([
            'user_id'         => (string) Str::uuid(),
            'username'        => $student->nre, // Use student's NRE as username
            'email'           => null, // Set email to null or pass an email if available
            'password'        => Hash::make('defaultpassword'), // Default password
            'docente_id_student' => $student->id_student, // Link to student
            'tipo_usuario'    => 'Estudante', // User type as 'Estudante'
        ]);

    }
    
    // Validate gender value
    private function validateGender($gender)
    {
        // Only allow 'Male' or 'Female'
        $allowed_genders = ['Male', 'Female'];

        return in_array($gender, $allowed_genders) ? $gender : null; // Return null if invalid
    }

    // Format the date
    private function formatDate($date)
    {
        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
