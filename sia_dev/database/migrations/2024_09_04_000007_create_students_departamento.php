<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTableEstudanteDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudante_departamento', function (Blueprint $table) {
            $table->uuid('id_departamento_studante')->primary(); // Primary key as UUID
            $table->uuid('id_departamento');       // Foreign key (UUID)
            $table->uuid('id_student');
            $table->uuid('id_faculdade');          // Foreign key (UUID)
            $table->text('controlo_estado');       // Text field
            $table->timestamps();                  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_estudante_departamento');
    }
}