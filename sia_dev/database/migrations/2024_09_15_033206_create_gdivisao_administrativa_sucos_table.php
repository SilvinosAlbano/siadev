<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGdivisaoAdministrativaSucosTable extends Migration
{
    public function up()
    {
        Schema::create('gdivisao_administrativa_sucos', function (Blueprint $table) {
            $table->uuid('id_sucos')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('sucos');
            $table->string('codigo_sucos')->nullable();
            $table->string('gdas_inserido_por')->nullable();
            $table->string('gdas_inserido_em')->nullable();
            $table->string('gdas_ultima_alteracao_por')->nullable();
            $table->string('gdas_ultima_alteracao_em')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gdivisao_administrativa_sucos');
    }
}
