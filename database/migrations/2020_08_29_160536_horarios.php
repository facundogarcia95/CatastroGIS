<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Horarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*  Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idempleado')->unsigned();
            $table->datetime('hora_entrada');
            $table->datetime('hora_salida');
            $table->boolean('lunes')->default(1);
            $table->boolean('martes')->default(1);
            $table->boolean('miercoles')->default(1);
            $table->boolean('jueves')->default(1);
            $table->boolean('viernes')->default(1);
            $table->boolean('sabado')->default(0);
            $table->boolean('domingo')->default(0);
            $table->timestamps();

            $table->foreign('idempleado')->references('id')->on('empleados');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::dropIfExists('horarios');

    }
}
