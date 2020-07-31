<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleReceta extends Model
{
    protected $table = 'detalle_recetas';
        
    protected $fillable = [
        'idreceta',
        'idproducto',
        'cantidad'
    ];
}
