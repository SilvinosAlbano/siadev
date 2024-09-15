<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGdivisaoAdministrativaPostoAdministrativoTable extends Migration
{
    public function up()
    {
        Schema::create('gdivisao_administrativa_posto_administrativo', function (Blueprint $table) {
            $table->uuid('id_posto_administrativo')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('posto_administrativo');
            $table->string('codigo_posto_administrativo')->nullable();
            $table->string('codigo_financa')->nullable();
            $table->string('gdap_inserido_por')->nullable();
            $table->string('gdap_inserido_em')->nullable();
            $table->string('gdap_ultima_alteracao_por')->nullable();
            $table->string('gdap_ultima_alteracao_em')->nullable();
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gdivisao_administrativa_posto_administrativo');
    }
}
