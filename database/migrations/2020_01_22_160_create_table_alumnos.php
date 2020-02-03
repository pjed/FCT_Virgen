<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('alumnos', function (Blueprint $table) {
            $table->string('dni', 9)->primary();
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('domicilio', 100);
            $table->string('email', 100)->nullable();
            $table->string('pass', 100);
            $table->string('telefono', 9);
            $table->string('movil', 9)->nullable();
            $table->string('iban', 24)->nullable();
            $table->string('roles_id', 3);
            $table->timestamps();
            
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
        Schema::dropIfExists('alumnos');
    }
}
