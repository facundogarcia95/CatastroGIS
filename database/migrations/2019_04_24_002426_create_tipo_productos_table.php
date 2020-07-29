<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        
            Schema::create('tipo_productos', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nombre');
                $table->timestamps();
            });
            
            $tipo = [
                ['nombre' => 'INSUMO', 'created_at' => now()],
                ['nombre' => 'PRODUCTO FINAL', 'created_at' => now()],
            ];
		    $db = DB::table('tipo_productos')->insert($tipo);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_productos');
    }
}
