<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonificacion extends Model
{
    //
    protected $table='tipos_bonificaciones';
    protected $fillable=[
       'tipo_bonificacion_codigo',
       'tipo_bonificacion_descrip',
       'tipo_bonificacion_porc',
       'tipo_estado_id'
      ];

    public function parcelas(){

        return $this->hasMany('App\Parcela');
    }

    public function estado(){

      return $this->belongsTo('App\Estado');
   }

}
