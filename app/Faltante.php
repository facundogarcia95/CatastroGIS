<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faltante extends Model
{
    //
    protected $table = 'faltantes';
        
        protected $fillable = [
            'idusuario',
            'motivo',
            'observacion'
        ];
        public $timestamps = true;

        /*es el usuario que hace el registro*/
     public function usuario()
     {
         return $this->belongsTo('App\User');
     }

}
