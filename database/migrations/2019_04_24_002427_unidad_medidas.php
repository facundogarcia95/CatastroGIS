<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnidadMedidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_medidas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unidad');
            $table->timestamps();
        });
        
        $unidad = [
            ['unidad' => 'Unidad - ud.', 'created_at' => now()],
            ['unidad' => 'Kilo gramos - kg', 'created_at' => now()],
            ['unidad' => 'Gramos - gr', 'created_at' => now()],
            ['unidad' => 'Metros - mts', 'created_at' => now()],
            ['unidad' => 'Centimetros - cm', 'created_at' => now()],
            ['unidad' => 'Milímetros - mm', 'created_at' => now()]
        ];
        $db = DB::table('unidad_medidas')->insert($unidad);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidad_medidas');
    }
}
