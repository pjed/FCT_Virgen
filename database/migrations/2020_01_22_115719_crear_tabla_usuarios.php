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
            $table->string('dni', 45)->primary();
            $table->string('email', 100);
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('cursos_centro_cod', 255);
            $table->timestamps();
            $table->foreign('cursos_centro_cod')->references('centro_cod')->on('cursos');
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
