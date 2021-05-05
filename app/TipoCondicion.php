<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCondicion extends Model
{
    protected $table='tipos_condiciones';

    protected  $primaryKey = 'tipo_condicion_id';

    protected $fillable=[
                        'tipo_condicion_descrip',
                        'tipo_condicion_abrev',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;
}
