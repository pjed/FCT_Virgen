<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPracticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::defaultStringLength(191);
        Schema::create('practicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dni_responsable',9);
            $table->string('cod_proyecto',50)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('empresa_cif',9);
            $table->string('alumno_dni',9);
            $table->timestamps();
            
            $table->foreign('alumno_dni')->references('dni')->on('alumnos');
            $table->foreign('empresa_cif')->references('cif')->on('empresas');
            $table->foreign('dni_responsable')->references('dni')->on('responsables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practicas');
    }
}