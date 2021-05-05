<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvaluoP extends Model
{
    protected $table='avaluo_p';
   
    protected $fillable=[
                        'MINIMO',
                        'MAXIMO',
                        'ED_TOTAL',
                        'ED_TASA',
                        'ED_INF',
                        'SC_TOTAL',
                        'SC_TASA',
                        'SC_INF',
                        'CC_TOTAL',
                        'CC_TASA',
                        'CC_INF',
                        'CU_TOTAL',
                        'CU_TASA',
                        'CU_INF',
                        'ID',
                        'f_vig_ini',
                        'f_vig_fin',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;
}

