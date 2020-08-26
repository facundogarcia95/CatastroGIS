<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAjuste extends Model
{
    protected $table = 'detalle_ajustes';
    protected $fillable = [
        'idajuste', 
        'idproducto',
        'cantidad'
          
    ];
    
    public $timestamps = false;
}
