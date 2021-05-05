<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMejoraDestino extends Model
{
    protected $table='tipos_mejoras_destinos';

    protected  $primaryKey = 'tipo_mejora_destino_id';

    protected $fillable=[
                        'tipo_mejora_destino_descrip',
                        'tipo_mejora_destino_abrev',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;
}
