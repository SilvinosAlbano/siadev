<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ModelFaculdade;
use Carbon\Carbon;

class FaculdadeSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $faculdades = [
            [
                'id_faculdade' => '1d1b3f74-16f0-4b14-bd36-4eae2a6b3c1d',
                'nome_faculdade' => 'Faculdade de Ciência de Saúde',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        ModelFaculdade::insert($faculdades);
    }
}
