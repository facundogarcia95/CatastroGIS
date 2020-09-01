<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;

class TiposNovedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_novedades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('denominacion',200);
            $table->text('cabecera');
            $table->timestamps();
        });

        $tipos = [
                    ['denominacion' => 'FAMILIARES', 'cabecera' => ""],
                    ['denominacion' => 'AUSENCIAS', 'cabecera' => ""],
                    ['denominacion' => 'APERCEBIMIENTOS', 'cabecera' => ""],
                    ['denominacion' => 'PREMIOS', 'cabecera' => ""],
                    ['denominacion' => 'VACACIONES', 'cabecera' => ""]
                 ];
            $db = DB::table('tipos_novedades')->insert($tipos);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_novedades');
    }
}
