<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    
    protected $table='personas';

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

    public function parcelas(){

      return $this->belongsToMany('App\Parcela', 'personas_parcelas','persona_id','parcela_id');
    
   }

   public function tipo_persona(){

      return $this->belongsTo('App\TipoPersona','tipo_persona_id');
  }

  public function pais(){

   return $this->belongsTo('App\Paises','pais_id');
}


}
