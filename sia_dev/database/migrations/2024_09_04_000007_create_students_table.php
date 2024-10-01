<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('students'); // Drop the table if it exists
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id_student')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->string('complete_name');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('nre')->nullable();
            $table->integer('start_year');
            $table->string('student_image')->nullable();
            $table->text('observation')->nullable();
            $table->text('controlo_estado')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
