<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvaluoTiempos extends Model
{
    protected $table='avaluo_tiempos';

    protected  $primaryKey = 'avaluo_tiempo_id';
   
    protected $fillable=[
                        'avaluo_tiempo_cant_parcelas',
                        'avaluo_tiempo_min_trans',
                        'avaluo_tiempo_fecha'
                        ];

    public $timestamps=false;
}