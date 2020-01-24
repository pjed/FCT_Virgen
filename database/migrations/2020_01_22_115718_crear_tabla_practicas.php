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
        Schema::create('practicas', function (Blueprint $table) {
            $table->string('id',255)->primary();
            $table->string('dni_representante',9);
            $table->string('dni_alumno',45);
            $table->string('cod_proyecto',50);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('empresa_cif',255);
            $table->timestamps();
            
            $table->foreign('empresa_cif')->references('cif')->on('empresa');
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
