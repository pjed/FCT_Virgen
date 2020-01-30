<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuarios extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->string('dni', 9)->primary();
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('domicilio', 100);
            $table->string('email', 100);
            $table->string('pass', 100);
            $table->string('telefono', 9);
            $table->string('movil', 9);
            $table->string('iban', 24);
            $table->string('cursos_id', 50);
            $table->timestamps();
            
            $table->foreign('cursos_id')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('usuarios');
    }

}
