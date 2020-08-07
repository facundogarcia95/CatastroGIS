<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleFatantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faltante_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idfaltante')->unsigned();
            $table->integer('idproducto')->unsigned();
            $table->string('cantidad');
            $table->timestamps();

            $table->foreign('idfaltante')->references('id')->on('faltantes');
            $table->foreign('idproducto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_faltantes');
    }
}
