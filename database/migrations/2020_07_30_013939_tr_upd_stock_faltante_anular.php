<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrUpdStockFaltanteAnular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER `tr_updStockFaltanteAnular` AFTER UPDATE ON `faltantes` FOR EACH ROW BEGIN
        UPDATE productos p
          JOIN detalle_faltantes df
            ON df.idproducto = p.id
           AND df.idfaltante= new.id
           SET p.stock = p.stock + df.cantidad;
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
        DB::unprepared('DROP TRIGGER `tr_updStockFaltanteAnular`');
    }
}
