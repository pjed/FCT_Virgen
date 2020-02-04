<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTutores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('tutores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cursos_id', 50);
            $table->string('profesores_dni', 9);
            $table->timestamps();
            $table->foreign('cursos_id')->references('id')->on('cursos');
            $table->foreign('profesores_dni')->references('dni')->on('profesores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutores');
    }
}
