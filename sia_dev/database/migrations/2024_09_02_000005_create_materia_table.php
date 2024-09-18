<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMateriaTable extends Migration
{
    public function up()
    {
        Schema::create('materia', function (Blueprint $table) {
            $table->uuid('id_materia')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('materia');
            $table->string('codigo_materia');
            $table->integer('creditos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materia');
    }
}
