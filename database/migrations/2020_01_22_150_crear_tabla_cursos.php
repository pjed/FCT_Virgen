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
        
        Schema::defaultStringLength(191);
        Schema::create('cursos', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('descripcion');
            $table->string('centro_cod');
            $table->string('ano_academico');
            $table->string('familia');
            $table->integer('horas')->nullable();
            $table->string('profesor_dni')->nullable();
            $table->timestamps();
            $table->foreign('centro_cod')->references('cod')->on('centros');
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
