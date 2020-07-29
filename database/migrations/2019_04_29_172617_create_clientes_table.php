<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100)->unique();
            $table->string('tipo_documento',20)->nullable();
            $table->string('num_documento',20)->nullable();
            $table->string('direccion',70)->nullable();
            $table->string('telefono',20)->nullable();
            $table->string('email',50)->nullable();
            $table->timestamps();
        });

        $cliente = [
            ['nombre' => 'SIN DEFINIR', 'tipo_documento' => 'DNI', 'num_documento' => '00000000', 'direccion' => 'SIN DEFINIR', 'telefono' => 'SIN DEFINIR','email' => 'SIN DEFINIR', 'created_at' => now()]
        ];

        $db = DB::table('clientes')->insert($cliente);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
