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
            $table->string('Nombre');
            $table->string('Cuil');
            $table->string('Email')->nullable();
            $table->string('Instagram')->nullable();
            $table->string('Facebook')->nullable();
            $table->float('impuesto');
            $table->string('Direccion')->nullable();
            $table->string('Telefono')->nullable();
            $table->string('web')->nullable();
            $table->string('logo');
            //$table->timestamps();
        });
        
        
        $negocio = [
                'Nombre' => 'Nombre negocio',
                'Cuil' => '20-12345678-7',
                'Email' => null, 
                'Instagram' => '@mendozasushi', 
                'Facebook' => 'mendoza.sushi', 
                'impuesto' => '21', 
                'Direccion' => null, 
                'Telefono' => '2612678891', 
                'web' => null, 
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
