<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IngresosSalidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos_salidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idempleado')->unsigned();
            $table->datetime('hora_entrada');
            $table->datetime('hora_salida')->nullable();

            $table->foreign('idempleado')->references('id')->on('empleados');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingresos_salidas');

    }
}
