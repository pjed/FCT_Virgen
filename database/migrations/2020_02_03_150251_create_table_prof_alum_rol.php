<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProfAlumRol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('prof_alum_rol', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profesores_dni', 9);
            $table->string('roles_id', 3);
            $table->timestamps();
            $table->foreign('profesores_dni')->references('dni')->on('profesores');
            $table->foreign('roles_id')->references('id')->on('roles');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prof_alum_rol');
    }
}
