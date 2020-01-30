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
        Schema::create('empresas', function (Blueprint $table) {
            $table->string('cif', 9)->primary();
            $table->string('nombre', 100);
            $table->string('dni_representante', 9);
            $table->string('nombre_representante', 100);
            $table->string('direccion', 200);
            $table->string('localidad', 200);
            $table->string('horario', 100);
            $table->integer('nueva')->nullable();
            $table->integer('gastos')->nullable();
            $table->integer('apto')->nullable();
            
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
