<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovedadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novedades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('idempleado')->unsigned();
            $table->integer('idtiponovedad')->unsigned();
            $table->boolean('estado')->default(1);
            $table->timestamps();

            $table->foreign('idempleado')->references('id')->on('empleados');
            $table->foreign('idtiponovedad')->references('id')->on('tipos_novedades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novedades');
    }
}
