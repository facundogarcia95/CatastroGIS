<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_producto extends Model
{
        //
        protected $table = 'tipos_productos';
    
        protected $fillable = ['nombre'];
}
