<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $table='tramites';

    protected  $primaryKey = 'tramite_id';

    protected $fillable=[
                        'parcela_id',
                        'tipo_tramite_id',
                        'tramite_nro_exp',
                        'tramite_letra_exp',
                        'tramite_fecha_exp',
                        'tramite_superficie',
                        'tramite_f_alta',
                        'mejora_id_old',
                        'tramite_f_baja',
                        'tramite_mot_baja',
                        'tramite_observacion',
                        'usuario_id',
                        'tipo_estado_id',
                        'audit_string'
                        ];

    public $timestamps=false;

    public function usuario(){
      return $this->belongsTo('App\User','usuario_id');
   }

   public function parcela(){
      return $this->belongsTo('App\Parcela','parcela_id');
   }

   public function estado(){
      return $this->belongsTo('App\TipoEstado','tipo_estado_id');
   }

   public function tipo_tramite(){
      return $this->belongsTo('App\TipoTramite','tipo_tramite_id');
   }
}
