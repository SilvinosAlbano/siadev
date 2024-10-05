<?php
namespace App\Imports;

use App\Models\ModelStudent;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class StudentImport implements ToModel
{
    public function model(array $row)
    {
        $gender = $this->validateGender($row[1]);
    
        // Skip the row if gender is null (invalid or missing)
        if (is_null($gender)) {
            return null;
        }
    
        return new ModelStudent([
            'complete_name'   => $row[0],
            'gender'          => $gender,
            'place_of_birth'  => $row[2],
            'date_of_birth'   => $this->formatDate($row[3]),
            'nre'             => $row[4],
            'start_year'             => $row[5],
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
