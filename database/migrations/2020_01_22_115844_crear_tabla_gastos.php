<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaGastos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->string('id',255)->primary();
            $table->integer('desplazamiento');
            $table->integer('tipo');
            $table->string('usuarios_dni', 9);
            $table->integer('transporte_id');
            $table->integer('comida_id');
            $table->float('total_gasto_alumno', 8, 2);
            $table->float('total_gasto_ciclo', 8, 2);
            $table->timestamps();
            $table->foreign('usuarios_dni')->references('dni')->on('usuarios');
            $table->foreign('transporte_id')->references('id')->on('transporte');
            $table->foreign('comida_id')->references('id')->on('comida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos');
    }
}
