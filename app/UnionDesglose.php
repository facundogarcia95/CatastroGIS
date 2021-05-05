<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnionDesglose extends Model
{
    //
    protected $table='uniones_desgloses';

    protected  $primaryKey = 'union_desglose_id';

    protected $fillable=[
       'parcela_id',
       'parcela_destino_id',
       'tipo_union_desglose_id',
       'union_desglose_fecha',
       'usuario_id',
       'padron_origen',
       'padron_destino'
      ];

    public $timestamps=false;


    public function parcela_destino(){
        return $this->belongsTo('App\Parcela','parcela_destino_id');
    }

    public function parcela_origen(){
      return $this->belongsTo('App\Parcela','parcela_id');
    }

    public function user(){
      return $this->belongsTo('App\User','usuario_id');
   }



}