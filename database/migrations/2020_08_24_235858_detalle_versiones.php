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
            ['idversion'=> 1, 'titulo' => 'Modificación de Comercio', 'descripcion' => 'Permite la modificación de datos de la empresa. <br/> La misma se visualiza al hacer click sobre el nombre de usuario ubicado en la parte superior derecha.'],
            ['idversion'=> 1,'titulo' => 'Búsqueda por fecha', 'descripcion' => 'Se encuentra disponible una nueva funcionalidad para búsqueda por fecha en módulos de Compras y Ventas.']
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
