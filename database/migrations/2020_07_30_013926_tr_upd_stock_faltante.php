<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrUpdStockFaltante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER `tr_updStockFaltante` AFTER INSERT ON `detalle_faltantes` FOR EACH ROW BEGIN
        UPDATE productos SET stock = stock - NEW.cantidad 
        WHERE productos.id = NEW.idproducto;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_updStockFaltante`');
    }
}
