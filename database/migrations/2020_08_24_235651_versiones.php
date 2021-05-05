<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Versiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versiones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('version');
            $table->text('descripcion');
            $table->date('fecha');

        });

        $versiones = [
            ['version' => '1.2.2', 'descripcion' => 'La versión 1.2.1 presenta nuevas funcionalidades, se agregó módulo de usuarios y breadcrumbs dinámico.', 'fecha' => now()]
        ];
        DB::table('versiones')->insert($versiones);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('versiones');
    }
}
