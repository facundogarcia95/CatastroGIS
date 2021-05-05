<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcelaUso extends Model
{
    //
    protected $table='tipos_parcelas_usos';
    protected $fillable=[
       'tipo_parcela_uso_descrip',
       'tipo_parcela_uso_abrev'
      ];

    public function parcelas(){

        return $this->hasMany('App\Parcela');
    }


}
