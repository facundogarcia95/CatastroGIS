<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoBonificacion extends Model
{
    protected $table='tipos_bonificaciones';

    protected  $primaryKey = 'tipo_bonificacion_id';

    protected $fillable=[
                        'tipo_bonificacion_codigo',
                        'tipo_bonificacion_descrip',
                        'tipo_bonificacion_porc',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;

    public function estado(){

        return $this->belongsTo('App\TipoEstado','tipo_estado_id');
    }

}
