<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    
    protected $table='tipos_personas';

    protected  $primaryKey = 'tipo_persona_id';

    protected $fillable=[
                     'tipo_persona_id',
                     'tipo_persona_descrip',
                     'tipo_persona_abrev'
                        ];

    public $timestamps=false;


}
