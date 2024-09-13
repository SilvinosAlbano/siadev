<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TipoEstatutoSeeder extends Seeder
{
    /**
     * Seed the tipo_estatuto table with dummy data.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id_estatuto' => (string) Str::uuid(),
                'estatuto' => 'Estatuto 1',
                'controlo_estado' => 'Active',
            ],
            [
                'id_estatuto' => (string) Str::uuid(),
                'estatuto' => 'Estatuto 2',
                'controlo_estado' => 'Inactive',
            ],
            [
                'id_estatuto' => (string) Str::uuid(),
                'estatuto' => 'Estatuto 3',
                'controlo_estado' => 'Pending',
            ],
        ];

        DB::table('tipo_estatuto')->insert($data);
    }
}
