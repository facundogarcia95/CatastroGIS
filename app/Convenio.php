<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $table = 'convenios_empleados';

    protected $fillable=[
        'idempleado',
        'idtipoliquidacion',
        'valor',
        'estado'
    ];

       /*es el empleado del registro*/
       public function empleado()
       {
           return $this->belongsTo('App\Empleado');
       }
}
