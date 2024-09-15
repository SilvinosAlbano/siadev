<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateGdivisaoAdministrativaPostoAdministrativoView extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW gdivisao_administrativa_posto_administrativo_view AS
                SELECT p.id_posto_administrativo,
                    p.posto_administrativo,
                    p.codigo_posto_administrativo,
                    s.id_sucos,
                    s.sucos,
                    s.codigo_sucos,
                    ps.id_controlo_posto_administrativo,
                    ps.data_inicio AS data_inicio_ps,
                    ps.data_fim AS data_fim_ps,
                    CASE
                        WHEN ps.data_fim IS NULL THEN 'Ativo'
                        ELSE NULL
                    END AS estado
                FROM gdivisao_administrativa_sucos s
                JOIN gdivisao_administrativa_controlo_posto_administrativos_sucos ps
                    ON ps.id_sucos = s.id_sucos
                JOIN gdivisao_administrativa_posto_administrativo p
                    ON p.id_posto_administrativo = ps.id_posto_administrativo        
                ORDER BY p.codigo_posto_administrativo, s.codigo_sucos;

        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS gdivisao_administrativa_posto_administrativo_view");
    }
}
