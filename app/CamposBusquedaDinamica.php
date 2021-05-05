<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CamposBusquedaDinamica extends Model
{
    //
    protected  $primaryKey = 'id_busqueda';

    protected $connection = 'mysql';

    protected $table='busqueda_dinamica_nuevo';

    protected $fillable=[
       'id_tabla_busqueda',
       'nombre_campo',
       'nombre_mostrado',
       'nombre_tabla',
       'cod_relacion',
       'orden'
      ];

    public $timestamps=false;
     
}