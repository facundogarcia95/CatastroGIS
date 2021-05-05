<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //
    protected $table='tipos_estados';

    protected $fillable=[
       'tipo_estado_descrip',
       'tipo_estado_abrev',
       'tipo_estado_valor',
       'tipo_estado_color',
       'tipo_estado_html'
      ];


    public function estados_parcelas(){

        return $this->hasMany('App\ParcelaEstado');
    }

    public function bonificaciones(){

        return $this->hasMany('App\Bonificacion');
    }





}