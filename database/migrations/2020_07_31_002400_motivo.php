<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Motivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('motivo');
            $table->timestamps();         
        });

        $motivos = [
            ['motivo' => 'ROTURA', 'created_at' => now()],
            ['motivo' => 'FALLA', 'created_at' => now()],
            ['motivo' => 'VENCIDO', 'created_at' => now()],
            ['motivo' => 'ROBO', 'created_at' => now()]
        ];
        $db = DB::table('motivos')->insert($motivos);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivos');
    }
}
