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
    public function up(): void
    {
        
        Schema::create('salas', function (Blueprint $table) {
            $table->uuid('id_sala')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->date('nome_sala');
            $table->timestamps();
            $table->softDeletes();
        });


        
    }

    public function down(): void
    {
        Schema::dropIfExists('salas');
    }
};
