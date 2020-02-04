<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaColectivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::defaultStringLength(191);
        Schema::create('colectivos', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->binary('foto');
            $table->string('n_dias');
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
        Schema::dropIfExists('colectivo');
    }
}
