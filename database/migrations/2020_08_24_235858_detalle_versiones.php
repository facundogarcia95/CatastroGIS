<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleVersiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_versiones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idversion')->unsigned();
            $table->string('titulo');
            $table->text('descripcion');

            $table->foreign('idversion')->references('id')->on('versiones');
           
        });

        $detalles = [
            ['idversion'=> 1, 'titulo' => 'Modificación de BreadCrumbs', 'descripcion' => 'Permite gerarquizar la pocisión dentro de la página.'],
            ['idversion'=> 1,'titulo' => 'Módulo de Usuarios', 'descripcion' => 'Se encuentra disponible para los usuarios administradores, en él gestionarán la creación y roles de accesos de los mismos.']
        ];
        DB::table('detalle_versiones')->insert($detalles);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_versiones');
    }
}
