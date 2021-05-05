<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CapasCartografia extends Model
{
    //
    protected $table='capas_cartografia';
    
    protected $fillable=[
       'nombre',
       'tipo',
       'espacio_trabajo',
       'formato',
       'version',
       'tiled',
       'style',
       'cql_filter',
       'visible',
       'opacidad',
       'grupo',
       'orden'
      ];



}
