<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvenioEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenios_empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idempleado')->unsigned();
            $table->integer('idtipoliquidacion')->unsigned();
            $table->float('valor');
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('idempleado')->references('id')->on('empleados');
            $table->foreign('idtipoliquidacion')->references('id')->on('tipos_liquidaciones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convenios_empleados');

    }
}
