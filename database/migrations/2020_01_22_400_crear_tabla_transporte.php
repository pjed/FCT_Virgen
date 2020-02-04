<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaTransporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::defaultStringLength(191);
        Schema::create('transportes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('tipo');
            $table->integer('donde');//Desde el instituto (1) o desde el domicilio (0)
            $table->integer('colectivo_id');
            $table->integer('propio_id');
            $table->timestamps();
            $table->foreign('colectivo_id')->references('id')->on('colectivos');
            $table->foreign('propio_id')->references('id')->on('propios');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transporte');
    }
}
