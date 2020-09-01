<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleNovedadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_novedades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idnovedad')->unsigned();
            $table->text('detalle');
            $table->timestamps();

            $table->foreign('idnovedad')->references('id')->on('novedades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_novedades');
    }
}
