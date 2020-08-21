<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $table = 'negocio';

    protected $fillable=[
        'Nombre',
        'Cuil',
        'Email',
        'Instagram',
        'Facebook',
        'impuesto',
        'Direccion',
        'Telefono',
        'web',
        'logo'
    ];
}
