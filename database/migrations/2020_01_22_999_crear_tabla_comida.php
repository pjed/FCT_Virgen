<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaComida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::defaultStringLength(191);
        Schema::create('comidas', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('importe', 8, 2);
            $table->date('fecha');
            $table->binary('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comida');
    }
}
