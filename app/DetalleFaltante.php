<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFaltante extends Model
{
    protected $table = 'detalle_faltantes';
    protected $fillable = [
        'idfaltante', 
        'idproducto',
        'cantidad'
          
    ];
    
    public $timestamps = false;
}
