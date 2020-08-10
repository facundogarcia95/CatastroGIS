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
            $table->string('web');
            $table->string('logo');
            //$table->timestamps();
        });
        
        
        $negocio = [
                'razon_social' => 'Nombre negocio',
                'cuil' => '20-12345678-7',
                'email' => 'negocio@gmail.com', 
                'impuesto' => '21', 
                'direccion' => 'calle 234 - Mendoza', 
                'telefono' => '2612678891', 
                'web' => 'nuestraempresa.com', 
                'logo' => '123456.png'
            ];

        $db = DB::table('negocio')->insert($negocio);
        
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
