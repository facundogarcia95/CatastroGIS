<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleNovedad extends Model
{
    protected $table = 'detalle_novedades';

    protected $fillable=[
        'idnovedad',
        'detalle'
    ];
}
