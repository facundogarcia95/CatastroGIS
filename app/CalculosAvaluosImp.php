<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalculosAvaluosImp extends Model
{
    protected $table='calculos_avaluos_imp';

    protected  $primaryKey = 'calculo_avaluo_imp_id';

    protected $fillable = [
                            'calculo_avaluo_imp_descr',
                            'calculo_avaluo_imp_abrev'
                            ];
    
    public $timestamps = false;
}