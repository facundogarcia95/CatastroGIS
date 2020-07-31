<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaltantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faltantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idusuarioregistro')->unsigned();
            $table->integer('idproducto')->unsigned();
            $table->integer('idmotivo')->unsigned();
            $table->integer('idusuarioresponsable')->unsigned()->nullable();
            $table->string('observacion');
            $table->integer('cantidad')->default(0);
            $table->timestamps();

            $table->foreign('idusuarioregistro')->references('id')->on('users');
            $table->foreign('idusuarioresponsable')->references('id')->on('users');
            $table->foreign('idproducto')->references('id')->on('productos');
            $table->foreign('idmotivo')->references('id')->on('motivos');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faltantes');
    }
}
