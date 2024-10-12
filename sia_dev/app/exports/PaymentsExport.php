<?php

namespace App\Exports;

use App\Models\ModelExportaPagamento;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromQuery, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = ModelExportaPagamento::query();

        // Apply filters
        if ($this->filters['department']) {
            $query->where('nome_departamento', $this->filters['department']);
        }
        if ($this->filters['year']) {
            $query->whereYear('data_selu', $this->filters['year']);
        }
        if ($this->filters['month']) {
            $query->whereMonth('data_selu', $this->filters['month']);
        }
        if ($this->filters['payment_status']) {
            $query->where('payment_status', $this->filters['payment_status']);
        }

        // Return only the necessary columns
        return $query->select(
            'nre',      // nre
            'complete_name',      // Nome
            'gender',             // Sexo
            'nome_departamento',  // Departamento
            'numero_semestre',    // Semestre
            'data_selu',          // Data Selu
            'total_paid',         // Total Selu
            'remaining_balance',  //remaining_balance
            'ano_academico',     //Tinan academic
            'payment_status'      // Status
        );
    }

    public function headings(): array
    {
        return [
            'NRE',           //  nre
            'Nome',           // Complete Name
            'Sexo',           // Gender
            'Departamento',   // Department
            'Semestre',       // Semester
            'Data Selu',      // Date Selu
            'Total Selu',     // Total Selu
            'Falta',          //remaining_balance
            'Tinan Akademik',   //Tinan academic
            'Status'          // Payment Status
        ];
    }

    public function map($row): array
    {
        return [
            $row->nre,    // Nome
            $row->complete_name,    // Nome
            $row->gender,           // Sexo
            $row->nome_departamento,// Departamento
            $row->numero_semestre,  // Semestre
            $row->data_selu,        // Data Selu
            $row->total_paid,       // Total Selu
            $row->remaining_balance,       // balanco
            $row->ano_academico,       // Tinan academic
            $row->payment_status    // Status
        ];
    }
}
