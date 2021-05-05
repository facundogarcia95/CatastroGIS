<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialBusquedaDinamica extends Model
{
    
    protected $table='historial_busquedas_dinamica';

    protected  $primaryKey = 'historial_busqueda_dinamica_id';

    protected $fillable=[
                     'historial_busqueda_dinamica_condicion',
                     'historial_busqueda_dinamica_sentencia',
                     'historial_busqueda_dinamica_fecha',
                     'usuario_id'
                        ];

    public $timestamps=false;


}
