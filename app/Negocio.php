<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $table = 'negocio';

    protected $fillable=['razon_social','cuil','email','impuesto','direccion','telefono'];
}
