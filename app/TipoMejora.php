<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMejora extends Model
{
    protected $table='tipos_mejoras';

    protected  $primaryKey = 'tipo_mejora_id';

    protected $fillable=[
                        'tipo_mejora_descrip',
                        'tipo_mejora_abrev',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;
}
