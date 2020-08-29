<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable=[
        'nombre',
        'apellido',
        'num_documento',
        'direccion',
        'telefono',
        'email',
        'foto',
        'estado'
    ];
}
