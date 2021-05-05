<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class utm extends Model
{
    protected $table='utm';

    protected  $primaryKey = 'utm_id';
   
    protected $fillable=[
                        'utm_valor',
                        'utm_fecha_ini',
                        'utm_fecha_fin',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;

    public function tipo_estado(){
        return $this->belongsTo('App\TipoEstado','tipo_estado_id');
    }

}





