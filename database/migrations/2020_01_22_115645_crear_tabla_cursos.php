<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('descripcion');
            $table->string('centro_cod');
            $table->string('ano_academico');
            $table->string('familia');
            $table->integer('horas');
            $table->string('tutor')->nullable();
            $table->timestamps();
            $table->foreign('centro_cod')->references('cod')->on('centro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
