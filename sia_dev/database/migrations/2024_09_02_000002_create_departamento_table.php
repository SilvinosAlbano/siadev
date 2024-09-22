<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->uuid('id_departamento')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('nome_departamento', 255);
            $table->uuid('id_faculdade');
            $table->foreign('id_faculdade')->references('id_faculdade')->on('faculdade');

            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamento');
    }
}
