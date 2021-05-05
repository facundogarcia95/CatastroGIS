<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    //
    protected  $primaryKey = 'direccion_id';

    protected $connection = 'mysql2';

    protected $table='direcciones';

    protected $fillable=[
            'direccion_nomencla',
            'provincia_id',
            'departamento_id',
            'distrito_id',
            'distrito_nombre',
            'barrio_id',
            'barrio_nombre',
            'calle_id',
            'calle_id_back',
            'calle_nombre',
            'calle_exter',
            'direccion_calle_intersec_id',
            'direccion_numeracion',
            'direccion_cp',
            'direccion_manzana',
            'direccion_casa',
            'direccion_local',
            'direccion_piso',
            'direccion_depto',
            'direccion_area',
            'direccion_torre',
            'direccion_lote',
            'direccion_observ',
            'direccion_string',
            'direccion_f_alta',
            'direccion_f_modif',
            'usuario_id_alta',
            'usuario_id_modif',
            'parcela_id',
            'parcela_padron',
            'parcela_nomencla',
            'parcela_nomencla16',
            'seccion_id',
            'direccion_x',
            'direccion_y',
            'tipo_estado_id',
            'parcela_tipo_estado_id',
            'comercio_segun_rentas',
            'ubicado',
            'direccion_forzada',
      ];

      public function estado(){

            return $this->belongsTo('App\TipoEstado','tipo_estado_id');
      }

      public function distrito(){

            return $this->belongsTo('App\Distrito','distrito_id');
      }
      
      public function ejes(){

            return $this->belongsTo('App\Ejes','calle_id','eje_id');
      }

      public $timestamps=false;

}