<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoRegimen extends Model
{
    protected $table='tipos_regimenes';

    protected  $primaryKey = 'tipo_regimen_id';

    protected $fillable=[
                        'tipo_regimen_descrip'
                        ];

    public $timestamps=false;
}