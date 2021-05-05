<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaNew extends Model
{
    
    protected $table='personas_new';

    protected  $primaryKey = 'persona_id';

    protected $fillable=[
                           'tipo_persona_id',
                           'tipo_documento_id',
                           'persona_nro_doc',
                           'persona_cuit',
                           'persona_es_cuit',
                           'persona_denominacion',
                           'persona_apellido',
                           'persona_nombre',
                           'persona_sexo',
                           'persona_fallecida',
                           'razon_social',
                           'persona_conyuge',
                           'persona_fecha_nac',
                           'pais_id',
                           'persona_tel_movil',
                           'tipo_estado_id',
                           'persona_email',
                           'persona_f_proce',
                           'persona_f_alta',
                           'usuario_id',
                           'tipo_persona_juridica_id'
                        ];

    public $timestamps=false;

}
