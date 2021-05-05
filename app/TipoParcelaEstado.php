<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoParcelaEstado extends Model
{
    protected $table='tipos_parcelas_estados';

    protected  $primaryKey = 'tipo_parcela_estado_id';

    protected $fillable=[
                        'tipo_parcela_estado_codigo',
                        'tipo_parcela_estado_descrip',
                        'tipo_parcela_estado_abrev',
                        'tipo_estado_id',
                        ];

    public $timestamps=false;

    public function parcelas(){

        return $this->hasMany('App\Parcelas','tipo_parcela_estado_id');
    }

    public function estado(){

        return $this->belongsTo('App\TipoEstado','tipo_estado_id');
    }

}
