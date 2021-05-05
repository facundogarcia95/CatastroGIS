<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPersonaJuridica extends Model
{
    
    protected $table='tipos_personas_juridicas';

    protected  $primaryKey = 'tipo_persona_juridica_id';

    protected $fillable=[
                     'tipo_persona_juridica_id',
                     'tipo_persona_juridica_descrip',
                     'tipo_persona_juridica_abrev'
                        ];

    public $timestamps=false;


}
