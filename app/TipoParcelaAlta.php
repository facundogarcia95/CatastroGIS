<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoParcelaAlta extends Model
{
    //
    protected $table='tipos_parcelas_altas';

    protected  $primaryKey = 'tipo_parcela_alta_id';


    protected $fillable=[
       'tipo_parcela_alta_abrev',
       'tipo_parcela_alta_desc'
      ];

    public $timestamps=false;
 
    public function parcelas(){

        return $this->hasMany('App\Parcelas','tipo_parcela_alta_id');
    }



}
