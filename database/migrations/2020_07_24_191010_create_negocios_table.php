<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razon_social');
            $table->string('cuil');
            $table->string('email');
            $table->float('impuesto');
            $table->string('direccion');
            $table->string('telefono');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negocio');
    }
}
