<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaParcela extends Model
{
    
    protected $table='personas_parcelas';

    protected  $primaryKey = 'persona_parcela_id';

    protected $fillable=[
                            'parcela_id',
                           'persona_id',
                           'tipo_instrumento_id',
                           'persona_parcela_num_int',
                           'persona_parcela_f_int',
                           'persona_parcela_dominio',
                           'tipo_persona_parcela_id',
                           'tipo_condicion_id',
                           'persona_parcela_origen',
                           'persona_parcela_f_pro',
                           'usuario_id',
                           'tipo_estado_id',
                           'persona_parcela_ppal',
                           'persona_parcela_observaciones'
                        ];

    public $timestamps=false;


}
