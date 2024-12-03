<?php

namespace App\Imports;

use App\Models\ModelDocente;
use App\Models\ModelFuncionarioDepartamento;
use App\Models\HabilitacaoModel;
use App\Models\FuncionarioEstatutoModel;
use App\Models\ModelNaturalidadeFuncionario;
use App\Models\ModelUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Ramsey\Uuid\Uuid;

class TeacherImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validate required fields
        if (empty($row['nome_funcionario']) || empty($row['sexo']) || empty($row['data_moris']) || empty($row['id_departamento'])) {
            return null; // Skip invalid rows
        }

        // Validate UUIDs for the "id_departamento" field
        if (!Str::isUuid($row['id_departamento'])) {
            return null; // Skip rows with invalid UUIDs
        }

       

        // Parse and validate dates
        $dataMoris = $this->parseDate($row['data_moris']);
        $anoInicio = $this->parseDate($row['ano_inicio']);

        // Handle optional fields
        $observacao = $row['observacao'] ?? null;
        $noContacto = $row['no_contacto'] ?? null;
        $email = $row['email'] ?? null;
        $titulu = $row['titulu'] ?? null;

        // Create the main ModelDocente record
        $docente = ModelDocente::create([
            'id_funcionario'   => (string) Str::uuid(),
            'nome_funcionario' => $row['nome_funcionario'],
            'sexo'             => $row['sexo'],
            'data_moris'       => $dataMoris,
            'categoria'        => $row['categoria'],
            'ano_inicio'       => $row['ano_inicio'],
            'observacao'       => $observacao,
            'no_contacto'      => $noContacto,
            'email'            => $email,
            'titulu'           => $titulu,
        ]);

        // Generate a username for the user model
        $username = $this->generateUsername($row['nome_funcionario']);

        // Create associated user
        ModelUser::create([
            'user_id'            => (string) Str::uuid(),
            'username'           => $username,
            'email'              => $email,
            'password'           => Hash::make('123456'), // Default password
            'docente_id_student' => $docente->id_funcionario,
            'tipo_usuario'       => 'Docente',
        ]);

        // Create related entries
        ModelFuncionarioDepartamento::create([
            'id_departamento_funcionario' => (string) Str::uuid(),
            'id_funcionario'              => $docente->id_funcionario,
            'id_departamento'             => $row['id_departamento'],
            'data_inicio'                 => $dataMoris,
        ]);

        // Create a new entry in the 'habilitacao' table
        HabilitacaoModel::create([
            'id_habilitacao' => (string) Str::uuid(),
            'id_funcionario' => $docente->id_funcionario,
            'habilitacao' => $row['habilitacao'] ?? null,
            'area_especialidade' => $row['area_especialidade'] ?? null,
            'universidade_origem' => $row['area_especialidade'] ?? null,
        ]);


        
        // Create a new entry in the 'estatuto' table
        FuncionarioEstatutoModel::create([
            'id_estatuto_funcionario' => (string) Str::uuid(),
            'id_funcionario' => $docente->id_funcionario,
            'id_estatuto' => $row['id_estatuto'],
            
        ]);
    }


    private function parseDate($date)
{
    try {
        return \Carbon\Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
    } catch (\Exception $e) {
        return now()->format('Y-m-d'); // Fallback to current date
    }
}

    private function generateUsername($fullName)
    {
        $unwanted = [
            'Á'=>'A', 'À'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'AE', 'Ç'=>'C',
            'É'=>'E', 'È'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Í'=>'I', 'Ì'=>'I', 'Î'=>'I', 'Ï'=>'I',
            'Ñ'=>'N', 'Ó'=>'O', 'Ò'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ú'=>'U',
            'Ù'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'á'=>'a', 'à'=>'a', 'â'=>'a', 'ã'=>'a',
            'ä'=>'a', 'å'=>'a', 'æ'=>'ae', 'ç'=>'c', 'é'=>'e', 'è'=>'e', 'ê'=>'e', 'ë'=>'e',
            'í'=>'i', 'ì'=>'i', 'î'=>'i', 'ï'=>'i', 'ñ'=>'n', 'ó'=>'o', 'ò'=>'o', 'ô'=>'o',
            'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ú'=>'u', 'ù'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '~'=>'', "'"=>""
        ];
        $cleanedName = strtr($fullName, $unwanted);
        $nameParts = explode(' ', $cleanedName);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[count($nameParts) - 1] ?? '';
        return strtolower($firstName . '.' . $lastName);
    }
}
