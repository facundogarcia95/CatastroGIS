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
        Schema::create('detalle_faltantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idfaltante')->unsigned();
            $table->integer('idproducto')->unsigned();
            $table->decimal('cantidad',11,2);
            $table->string('motivo')->nullable(false);

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
