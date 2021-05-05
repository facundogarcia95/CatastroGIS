<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalculosAvaluosAuto extends Model
{
    protected $table='calculos_avaluos_auto';

    protected  $primaryKey = 'calculo_avaluo_auto_id';

    protected $fillable = [
                            'calculo_avaluo_auto_descr',
                            'calculo_avaluo_auto_abrev'
                            ];
    
    public $timestamps = false;
}