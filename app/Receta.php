<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = 'recetas';
        
        protected $fillable = [
            'idusuario',
            'nombre',
            'condicion'
        ];

        /*es el usuario que hace el registro*/
     public function usuario()
     {
         return $this->belongsTo('App\User');
     }
}
