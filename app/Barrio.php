<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    //
    protected  $primaryKey = 'barrio_id';

    protected $connection = 'mysql2';

    protected $table='barrios_gllen';

    protected $fillable=[
       'barrio_nombre',
       'barrio_loteo',
       'barrio_empresa',
       'id_empresa',
       'departamento_id',
       'distrito_id',
       'nombre_alternativo',
       'estado_barrio_id',
       'dominio_barrio_id',
       'fuente_barrio_id',
       'zona_barrio',
       'nro_zona_barrio',
       'nro_plano_barrio',
       'fecha_plano_barrio',
       'matricula_profesional',
       'expediente_barrio',
       'observacion',
       'usuario_f_alta',
       'usuario_alta_id',
       'usuario_f_modif',
       'usuario_modif_id',
       'tipo_estado_id',
      ];
      
      public $timestamps=false;

}
