<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Parcela extends Model
{
    //
    protected $table='parcelas';

    protected  $primaryKey = 'parcela_id';

    protected $fillable=[
      'tipo_parcela_estado_id',
      'parcela_nomenclatura',
      'parcela_dependencia',
      'parcela_distrito',
      'parcela_seccion',
      'parcela_manzana',
      'parcela_parcela',
      'parcela_subparcela' ,
      'parcela_dig_veri' ,
      'parcela_padron',
      'parcela_padron_terr',
      'parcela_fraccion_ori',
      'uni_med_id',
      'parcela_super_mensura',
      'parcela_super_titulo',
      'parcela_super_cultivada',
      'parcela_super_libre',
      'parcela_padron_pasaje',
      'parcela_plano_nro',
      'parcela_plano_fecha',
      'parcela_lateral_norte',
      'parcela_lateral_sur',
      'parcela_lateral_este',
      'parcela_lateral_oeste',
      'parcela_ochava',
      'parcela_lado_frente',
      'parcela_avaluo',
      'parcela_avaluo_imp',
      'parcela_avaluo_utm',
      'parcela_porc_comun',
      'parcela_porc_uf',
      'parcela_sup_uf',
      'tipo_parcela_uso_id',
      'tipo_bonificacion_id',
      'tipo_estado_id',
      'tipo_parcela_ryb_id',
      'parcela_f_proceso',
      'parcela_f_estado',
      'parcela_f_alta',
      'direccion_nomencla_rud_real',
      'direccion_nomencla_rud_postal',
      'tipo_parcela_alta_id',
      'usuario_id',
      'tipo_nomenclatura',
      'nomencla_proceso_dpc',
      'parcela_observacion',
      'parcela_expediente',
      'parcela_x',
      'parcela_y',
      'wkt',
      'geom',
      'produccion'
   ];

   public $timestamps=false;

   
   public function tipo_estado(){

         return $this->belongsTo('App\ParcelaEstado');
   }

   public function tipo_uso(){

      return $this->belongsTo('App\ParcelaUso','tipo_parcela_uso_id');
   }

   public function unidad_medida(){

      return $this->belongsTo('App\UnidadMedida','uni_med_id');
   }

   public function usuario(){

      return $this->belongsTo('App\User','usuario_id');
   }

   public function personas($parcela = null){

      if(!$parcela){
         $parcela = $this->parcela_id;
      }
      return Persona::join('personas_parcelas','personas_parcelas.persona_id','=','personas.persona_id')
      ->join('parcelas','parcelas.parcela_id','=','personas_parcelas.parcela_id')
      ->where('parcelas.parcela_id','=',$parcela)->where('personas_parcelas.tipo_estado_id','=',1)
      ->orderBy('personas_parcelas.tipo_persona_parcela_id','ASC')->get();

      //return $this->belongsToMany('App\Persona', 'personas_parcelas','parcela_id','persona_id');
   
   }

   public function servicios(){

      return DB::table('parcelas_servicios')->where('parcela_id','=',$this->parcela_id)->where('estado_id','=',1)->get();
   
   }

   public function parcela_tipo_estado(){

      return $this->belongsTo('App\TipoParcelaEstado','tipo_parcela_estado_id');
   }

   public function tipo_nomenclatura(){

      return $this->belongsTo('App\TipoNomenclatura','tipo_nomenclatura');
   }

   public function mejoras($parcela = null){

      if(!$parcela){
         $parcela = $this->parcela_id;
      }
      return Mejora::select('mejoras.*','tipos_mejoras_usos.*','tipos_mejoras.*','tipos_mejoras_categorias.*','tipos_mejoras_estados.*')
      ->join('parcelas','parcelas.parcela_id','=','mejoras.parcela_id')
      ->join('tipos_mejoras_usos','tipos_mejoras_usos.tipo_mejora_uso_id','=','mejoras.tipo_mejora_uso_id')
      ->join('tipos_mejoras','tipos_mejoras.tipo_mejora_id','=','mejoras.tipo_mejora_id')
      ->join('tipos_mejoras_categorias','tipos_mejoras_categorias.tipo_mejora_categoria_id','=','mejoras.tipo_mejora_categoria_id')
      ->join('tipos_mejoras_estados','tipos_mejoras_estados.tipo_mejora_estado_id','=','mejoras.tipo_mejora_estado_id')
      ->where('mejoras.parcela_id','=',$parcela)
      ->where('mejoras.tipo_estado_id','=',1)->get();
  }

  public function tramites(){

   return $this->hasMany('App\Tramite','parcela_id');
   }
   
}
