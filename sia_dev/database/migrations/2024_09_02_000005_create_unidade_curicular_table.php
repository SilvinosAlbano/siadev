<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Create the unidade_curricular table
        Schema::create('unidade_curricular', function (Blueprint $table) {
            $table->uuid('id_unidade_curricular')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('unidade_curricular');
            $table->integer('creditos');
            $table->uuid('id_semestre');
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('id_semestre')->references('id_semestre')->on('semestre')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Drop the unidade_curricular table
        Schema::dropIfExists('unidade_curricular');
    }
};
