<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEstado extends Model
{
    protected $table='tipos_estados';

    protected  $primaryKey = 'tipo_estado_id';
   
    protected $fillable=[
                        'tipo_estado_descrip',
                        'tipo_estado_abrev',
                        'tipo_estado_valor',
                        'tipo_estado_color',
                        'tipo_estado_html'
                        ];

    public $timestamps=false;
}
