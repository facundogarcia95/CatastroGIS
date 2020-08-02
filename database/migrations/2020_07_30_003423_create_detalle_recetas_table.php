<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_recetas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idreceta')->unsigned();
            $table->integer('idproducto')->unsigned();
            $table->decimal('cantidad', 11, 2);
            $table->timestamps();

            $table->foreign('idreceta')->references('id')->on('recetas')->onDelete('cascade');
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
        Schema::dropIfExists('detalle_recetas');
    }
}
