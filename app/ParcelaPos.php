<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcelaPos extends Model
{
    //
    protected  $primaryKey = 'nomenc21';

    protected $connection = 'pgsql';

    protected $table='gllen_parcelas_pos';

    protected $fillable=[
      'id',
      'nomenc21',
      'fecha_m',
      'usuario_m',
      'detall_obs',
      'tipo_parce',
      'estado_par',
      'origen',
      'barrio_id',
      'id_des',
      'shape_area',
      'perimeter',
      'geom'
     ];
     
     public $timestamps=false;

}