<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAfectacion extends Model
{
    protected $table='tipos_afectaciones';

    protected  $primaryKey = 'tipo_afectacion_id';

    protected $fillable=[
                        'tipo_afectacion_codigo',
                        'tipo_afectacion_descrip',
                        'tipo_estado_id',
                        'seccion_id'
                        ];

    public $timestamps=false;

    public function estado(){

        return $this->belongsTo('App\TipoEstado','tipo_estado_id');
    }

    public function seccion(){

        return $this->belongsTo('App\Seccion','seccion_id');
    }

}
