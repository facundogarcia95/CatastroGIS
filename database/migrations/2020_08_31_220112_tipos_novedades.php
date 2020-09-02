<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


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
            $table->timestamps();
        });

        $tipos = [
                    ['denominacion' => 'FAMILIARES'],
                    ['denominacion' => 'AUSENCIAS'],
                    ['denominacion' => 'APERCEBIMIENTOS'],
                    ['denominacion' => 'PREMIOS'],
                    ['denominacion' => 'VACACIONES']
                 ];
        DB::table('tipos_novedades')->insert($tipos);
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
