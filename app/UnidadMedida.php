<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    //
    protected $table='unidades_medidas';

    protected $fillable=[
       'unidades_medidas_descrip',
       'unidades_medidas_abrev',
       'unidades_medidas_htm',
       'unidades_medidas_metros'
      ];

    public $timestamps=false;


    public function parcelas_unidad(){
        return $this->hasMany('App\Parcela');
    }




}