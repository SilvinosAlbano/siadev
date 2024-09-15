<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGdivisaoAdministrativaSucosAldeiasView extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW gdivisao_administrativa_sucos_aldeias_view AS
            SELECT s.id_sucos,
                s.sucos,
                s.codigo_sucos,
                a.id_aldeias,
                a.aldeias,
                a.codigo_aldeias,
                sa.id_contolo_sucos_aldeias,
                sa.data_inicio AS data_inicio_sa,
                sa.data_fim AS data_fim_sa,
                a.gdal_inserido_por,
                a.gdal_inserido_em,
                a.gdal_ultima_alteracao_por,
                a.gdal_ultima_alteracao_em,
                    CASE
                        WHEN sa.data_fim IS NULL THEN 'Ativo'
                        ELSE NULL
                    END AS estado
            FROM gdivisao_administrativa_aldeias a
                JOIN gdivisao_administrativa_controlo_sucos_aldeias sa ON sa.id_aldeias = a.id_aldeias
                JOIN gdivisao_administrativa_sucos s ON s.id_sucos = sa.id_sucos
            ORDER BY s.codigo_sucos, a.codigo_aldeias;
        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS gdivisao_administrativa_sucos_aldeias_view");
    }
}

