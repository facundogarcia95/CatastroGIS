<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
   
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nombre',100);
                $table->string('tipo_documento',20)->nullable();
                $table->string('num_documento',20)->nullable();
                $table->string('direccion',70)->nullable();
                $table->string('telefono',20)->nullable();
                $table->string('email',50)->nullable();
                $table->string('usuario')->unique();
                $table->string('password');
                $table->boolean('condicion')->default(1);
                $table->integer('idrol')->unsigned();
                $table->foreign('idrol')->references('id')->on('roles');
                $table->string('imagen',70)->nullable();
                $table->rememberToken();
                $table->timestamps();
            });


            $user = [
                    ['nombre' => 'Administrador','email' => 'administrador@gmail.com', 'usuario' => 'administrador', 'password' => bcrypt('administrador2315'), 'condicion' => 1, 'idrol' => 1, 'imagen' => '123456.png'],
                    ['nombre' => 'Vendedor','email' => 'vendedor@gmail.com', 'usuario' => 'vendedor', 'password' => bcrypt('vendedor2315'), 'condicion' => 1, 'idrol' => 2, 'imagen' => '123456.png'],
                    ['nombre' => 'Comprador','email' => 'comprador@gmail.com', 'usuario' => 'comprador', 'password' => bcrypt('comprador2315'), 'condicion' => 1, 'idrol' => 3, 'imagen' => '123456.png']
                    ];
		    $db = DB::table('users')->insert($user);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
