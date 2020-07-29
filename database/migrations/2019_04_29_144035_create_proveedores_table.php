<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100)->unique();
            $table->string('tipo_documento',20)->nullable();
            $table->string('num_documento',20)->nullable();
            $table->string('direccion',70)->nullable();
            $table->string('telefono',20)->nullable();
            $table->string('email',50)->nullable();
            $table->timestamps();
        });

        $proveedor = [
            ['nombre' => 'Proveedor 1', 'tipo_documento' => 'DNI', 'num_documento' => '12345567', 'direccion' => 'SIN CALLE', 'telefono' => '2612288191','email' => 'administrador@gmail.com', 'created_at' => now()]
        ];

        $db = DB::table('proveedores')->insert($proveedor);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedores');
    }
}
