<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       

        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcategoria')->unsigned();
            $table->string('codigo',50)->nullable();
            $table->string('nombre',100)->unique();
            $table->decimal('precio_venta',11,2)->default(0);
            $table->integer('stock')->default(0);
            $table->boolean('condicion')->default(1);
            $table->integer('tipo_producto')->unsigned()->default(1);
            $table->string('imagen')->default('noImagen.jpg');
            $table->integer('unidad_medida')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('idcategoria')->references('id')->on('categorias');
            $table->foreign('tipo_producto')->references('id')->on('tipo_productos');
            $table->foreign('unidad_medida')->references('id')->on('unidad_medidas');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
