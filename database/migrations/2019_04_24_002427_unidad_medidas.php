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
            ['unidad' => 'U.', 'created_at' => now()],
            ['unidad' => 'kg.', 'created_at' => now()],
            ['unidad' => 'gr.', 'created_at' => now()],
            ['unidad' => 'mg.', 'created_at' => now()],
            ['unidad' => 'l.', 'created_at' => now()],
            ['unidad' => 'ml.', 'created_at' => now()],
            ['unidad' => 'm.', 'created_at' => now()],
            ['unidad' => 'cm.', 'created_at' => now()],
            ['unidad' => 'mm.', 'created_at' => now()]
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
