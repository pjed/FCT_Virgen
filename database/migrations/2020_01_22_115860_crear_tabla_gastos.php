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
            $table->string('usuarios_dni', 45);
            $table->string('transporte_id',255);
            $table->string('comida_id',255);
            $table->timestamps();
            $table->foreign('transporte_id')->references('id')->on('transporte');
            $table->foreign('comida_id')->references('id')->on('comida');
            $table->foreign('usuarios_dni')->references('dni')->on('usuarios');
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
