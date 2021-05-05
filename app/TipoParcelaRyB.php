<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoParcelaRyB extends Model
{
    protected $table='tipos_parcelas_ryb';

    protected  $primaryKey = 'tipo_parcela_ryb_id';

    protected $fillable=[
                        'tipo_parcela_ryb_codigo',
                        'tipo_parcela_ryb_descrip',
                        'tipo_parcela_ryb_abrev',
                        'tipo_estado_id',
                        'tipo_parcela_ryb_tipo',
                        'tipo_parcela_utm',
                        'utm_fecha_desde',
                        'utm_fecha_hasta',
                        'normal_coeficiente',
                        'normal_utm',
                        'normal_pesos'
                        ];

    public $timestamps=false;

    public function parcelas(){

        return $this->hasMany('App\Parcelas','tipo_parcela_ryb_id');
    }

    public function estado(){

        return $this->belongsTo('App\TipoEstado','tipo_estado_id');
    }

}