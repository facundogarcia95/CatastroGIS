<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoInstrumento extends Model
{
    protected $table='tipos_instrumentos';

    protected  $primaryKey = 'tipo_instrumento_id';

    protected $fillable=[
                        'tipo_instrumento_descrip',
                        'tipo_instrumento_abrev',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;
}
