<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTramite extends Model
{
    protected $table='tipos_tramites';

    protected  $primaryKey = 'tipo_tramite_id';

    protected $fillable=[
                        'tipo_tramite_codigo',
                        'tipo_tramite_descrip',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;
    
    public function estado(){
      return $this->belongsTo('App\TipoEstado','tipo_estado_id');
   }
   
}