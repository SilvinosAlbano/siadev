<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->uuid('id_docente')->primary(); // Set as primary key and UUID type
            $table->string('nome_docente');
            $table->string('sexo');
            $table->uuid('id_suco');
            $table->uuid('id_posto_administrativo');
            $table->uuid('id_municipio');
            $table->date('data_moris');
            $table->string('nacionalidade');
            $table->string('categoria');
            $table->string('nivel_educacao')->nullable();
            $table->string('area_especialidade')->nullable();
            $table->string('universidade_origem')->nullable();
            $table->date('ano_inicio')->nullable();
            $table->uuid('id_tipo_categoria')->nullable();
            $table->uuid('id_estatuto');
            $table->uuid('id_departamento');
            $table->text('observacao')->nullable();
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
        Schema::dropIfExists('docentes');
    }
}
