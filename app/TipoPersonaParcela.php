<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPersonaParcela extends Model
{
    protected $table='tipos_personas_parcelas';

    protected  $primaryKey = 'tipo_persona_parcela_id';

    protected $fillable=[
                        'tipo_persona_parcela_descrip',
                        'tipo_persona_parcela_abrev',
                        'tipo_persona_parcela_ppal',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;
}
