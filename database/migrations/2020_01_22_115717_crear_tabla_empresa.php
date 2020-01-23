<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaEmpresa extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('empresa', function (Blueprint $table) {
            $table->string('cif', 255)->primary();
            $table->string('nombre', 100);
            $table->string('dni_responsable', 9);
            $table->string('nombre_responsable', 100);
            $table->string('direccion', 200);
            $table->string('localidad', 200);
            $table->string('horario', 100);
            $table->integer('nueva');
            $table->integer('gastos');
            $table->integer('apto');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('empresa');
    }

}
