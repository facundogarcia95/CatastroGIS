<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCoefServ extends Model
{
    protected $table='tipos_coef_serv';

    protected $fillable=[
                        'tipo_coef_serv',
                        'tipo_coef_serv_cant',
                        'tipo_coef_serv_coef'
                        ];

    public $timestamps=false;

}
