<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MejoraUso extends Model
{
    protected $table='tipos_mejoras_usos';

    protected $primaryKey = 'tipo_mejora_uso_id';

    protected $fillable=[
                        'tipo_mejora_uso_codigo',
                        'tipo_mejora_uso_descrip',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;

    public function estado(){
      return $this->belongsTo('App\TipoEstado','tipo_estado_id');
   }
}