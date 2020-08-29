<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    protected $table = 'horarios';

    protected $fillable=[
        'iempleado',
        'hora_entrada',
        'hora_salida',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
        'estado'
    ];

      /*es el empleado del registro*/
      public function empleado()
      {
          return $this->belongsTo('App\Empleado');
      }
}
