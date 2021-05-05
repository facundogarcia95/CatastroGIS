<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalculoAvaluo extends Model
{

    protected $table='calculos_avaluo';

    protected  $primaryKey = 'calculo_avaluo_id';

    protected $fillable=[
       'tipo_parcela_estado_id',
       'tipo_parcela_ryb_id',
       'calculo_avaluo_auto',
       'calculo_avaluo_imp'
      ];

    public $timestamps=false;

    public function estado_parcela(){
        return $this->belongsTo('App\TipoParcelaEstado','tipo_parcela_estado_id');
    }

    public function ryb_parcela(){
        return $this->belongsTo('App\TipoParcelaRyB','tipo_parcela_ryb_id');
    }

    public function avaluo_auto(){
        return $this->belongsTo('App\CalculosAvaluosAuto','calculo_avaluo_auto_id','calculo_avaluo_auto');
    }

    public function avaluo_imp(){
        return $this->belongsTo('App\CalculosAvaluosImp','calculo_avaluo_imp_id','calculo_avaluo_imp');
    }
}