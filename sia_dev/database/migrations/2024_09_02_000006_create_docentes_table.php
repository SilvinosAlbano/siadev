<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('funcionario', function (Blueprint $table) {
            $table->uuid('id_funcionario')->primary()->default(DB::raw('gen_random_uuid()')); // Set as primary key and UUID type
            $table->string('nome_funcionario');
            $table->string('sexo');
            $table->uuid('id_aldeias');
            $table->uuid('id_suco');
            $table->uuid('id_posto_administrativo');
            $table->uuid('id_municipio');
            $table->date('data_moris');
            $table->string('nacionalidade');
            $table->string('categoria');
            $table->date('ano_inicio')->nullable();
            $table->uuid('id_tipo_categoria')->nullable();
            $table->uuid('id_estatuto');
            $table->text('observacao')->nullable();
            $table->text('no_contacto')->nullable();
            $table->text('email')->nullable();
            $table->string('photo_docente')->nullable();
            $table->string('controlo_estado')->nullable();

            // Add timestamps (created_at, updated_at)
            $table->timestamps();

            // Add soft deletes (deleted_at)
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario');
    }
}
