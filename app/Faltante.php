<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faltante extends Model
{
    //
    protected $table = 'faltantes';
        
        protected $fillable = [
            'idusuarioregistro',
            'idproducto',
            'idmotivo',
            'idusuarioresponsable',
            'observacion',
            'cantidad'
        ];

        /*es el usuario que hace el registro*/
     public function usuario()
     {
         return $this->belongsTo('App\User');
     }

}
