<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('public.docentes', function (Blueprint $table) {
            $table->uuid('id_docente')->primary(); // Set as primary key and UUID type
            $table->string('nome_docente');
            $table->string('sexo');
            $table->string('suco');
            $table->string('posto_administrativo');
            $table->string('municipio');
            $table->date('data_moris');
            $table->string('nacionalidade');
            $table->string('nivel_educacao')->nullable();
            $table->string('area_especialidade')->nullable();
            $table->string('universidade_origem')->nullable();
            $table->year('ano_inicio')->nullable();
            $table->string('categoria_estatuto');
            $table->string('departamento');
            $table->text('observacao')->nullable();
            $table->string('photo_docente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public.docentes');
    }
};
