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
            ['unidad' => 'UD.', 'created_at' => now()],
            ['unidad' => 'KG.', 'created_at' => now()],
            ['unidad' => 'GR.', 'created_at' => now()],
            ['unidad' => 'MTS.', 'created_at' => now()],
            ['unidad' => 'CM.', 'created_at' => now()],
            ['unidad' => 'MM.', 'created_at' => now()]
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
