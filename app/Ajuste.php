<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    //
    protected $table = 'ajustes';
        
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
