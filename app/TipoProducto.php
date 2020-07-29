<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
        //
        protected $table = 'tipo_productos';
    
        protected $fillable = ['nombre'];
}
