<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentoTable extends Migration
{
    public function up()
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->uuid('id_departamento')->primary();
            $table->string('departamento');
            $table->string('faculdade')->default('Ciência de Saúde'); // Default value
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departamento');
    }
}
