<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MejoraConstruccion extends Model
{
    protected $table = 'tipos_mejoras_categorias';

    protected $primaryKey = 'tipo_mejora_categoria_id';

    protected $fillable = [
                           'tipo_mejora_categoria_codigo',
                           'tipo_mejora_categoria_descrip',
                           'tipo_mejora_categoria_coeficiente',
                           'tipo_estado_id',
                           'ph'
                           ];

    public $timestamps=false;

    public function tipo_estado(){

      return $this->belongsTo('App\TipoEstado','tipo_estado_id');
      
   }
}