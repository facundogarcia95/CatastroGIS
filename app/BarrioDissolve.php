<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarrioDissolve extends Model
{
    //
    protected  $primaryKey = 'id';

    protected $connection = 'pgsql';

    protected $table='barrios_dissolve';

    protected $fillable=[
      'geom',
      'barrio_id',
      'barrio_nombre',
      'id_empresa',
      'departamento',
      'distrito',
      'nombre_alternativo',
      'estado_barrio',
      'dominio_barrio',
      'fuente_barrio',
      'nro_plano_barrio',
      'fecha_plano_barrio',
      'matricula_profesional',
      'expediente_barrio',
      'observacion',
      'usuario_f_alta',
      'usuario_alta_id',
      'usuario_f_modif',
      'usuario_modif_id'
     ];
     
     public $timestamps=false;

}