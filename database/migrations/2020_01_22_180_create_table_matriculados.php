<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMatriculados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('curso_id', 50);
            $table->string('alumno_dni', 9);
            $table->timestamps();
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('alumno_dni')->references('dni')->on('alumnos');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculados');
    }
}
