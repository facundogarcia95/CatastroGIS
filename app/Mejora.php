<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mejora extends Model
{
    protected $table='mejoras';

    protected  $primaryKey = 'mejora_id';
   
   /*
   tipo_mejora_estado_id
   ver modelo de esto
   */

    protected $fillable=[
                           'parcela_id',
                           'tipo_mejora_id',
                           'tipo_mejora_estado_id',
                           'tipo_mejora_categoria_id',
                           'tipo_mejora_destino_id',
                           'tipo_mejora_uso_id',
                           'mejora_nro_exp',
                           'mejora_letra_exp',
                           'mejora_fecha_exp',
                           'mejora_sup_cub',
                           'mejora_sup_semi_cub',
                           'mejora_sup_comun_ph',
                           'mejora_porc_dominio',
                           'mejora_f_alta',
                           'mejora_f_pro',
                           'mejora_clandestina_id',
                           'tipo_exp_avaluo_id',
                           'tipo_estado_id',
                           'mejora_categoria_dpc',
                           'mejora_id_old',
                           'mejora_valor',
                           'mejora_f_baja',
                           'mejora_mot_baja',
                           'mejora_observacion',
                           'usuario_id'
                        ];

    public $timestamps=false;

   public function tipo_mejora(){
      return $this->belongsTo('App\TipoMejora','tipo_mejora_id');
   }

   public function tipo_mejora_categoria(){
      return $this->belongsTo('App\MejoraConstruccion','tipo_mejora_categoria_id');
   }

   public function tipo_mejora_destino(){
      return $this->belongsTo('App\TipoMejoraDestino','tipo_mejora_destino_id');
   }

   public function tipo_mejora_uso(){
      return $this->belongsTo('App\MejoraUso','tipo_mejora_uso_id');
   }

   public function tipo_estado(){
      return $this->belongsTo('App\TipoEstado','tipo_estado_id');
   } 

   public function parcela(){
      return $this->belongsTo('App\Parcela','parcela_id');
   }
}