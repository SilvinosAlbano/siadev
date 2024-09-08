<?php
namespace App\Exports;

use App\Models\ModelDocente;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DocentesExport implements FromQuery, WithHeadings
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = ModelDocente::query();
        
        // Apply filters
        if (!empty($this->filters['nome_docente'])) {
            $query->where('nome_docente', 'like', "%{$this->filters['nome_docente']}%");
        }
        if (!empty($this->filters['sexo'])) {
            $query->where('sexo', $this->filters['sexo']);
        }
        if (!empty($this->filters['id_estatuto'])) {
            $query->where('id_estatuto', $this->filters['id_estatuto']);
        }
        if (!empty($this->filters['nivel_educacao'])) {
            $query->where('nivel_educacao', 'like', "%{$this->filters['nivel_educacao']}%");
        }
        if (!empty($this->filters['controlo_estado'])) {
            $controlo_estado = $this->filters['controlo_estado'] == 'active' ? null : 'deleted';
            $query->where('controlo_estado', $controlo_estado);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nome Docente',
            'Sexo',
            'Data Moris',
            'Nivel Educacao',
            'Area Especialidade',
            'Ano Inicio',
            'Controlo Estado',
        ];
    }
}
