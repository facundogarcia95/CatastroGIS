<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoNovedad extends Model
{
    protected $table = 'tipos_novedades';

    protected $fillable=[
        'denominacion'
    ];
}
