<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProfesional extends Model
{
    protected $table='tipos_profesionales';

    protected  $primaryKey = 'tipo_profesional_id';

    protected $fillable=[
                        'tipo_profesional_descrip',
                        'tipo_profesional_abrev'
                        ];

    public $timestamps=false;
}
