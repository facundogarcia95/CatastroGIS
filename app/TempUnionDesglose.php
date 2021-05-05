<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempUnionDesglose extends Model
{
    protected $table='tmp_union_desglose';

    protected  $primaryKey = 'parcela_id';

    protected $fillable=[
                        'fecha',
                        'usuario_id',
                        'operacion',
                        'udparcela_nomencla_origen',
                        'udparcela_dependencia',
                        'udparcela_distrito',
                        'udparcela_distrito',
                        'udparcela_seccion',
                        'udparcela_manzana',
                        'udparcela_parcela',
                        'udparcela_subparcela',
                        'udparcela_dig_veri',
                        'udX',
                        'udY',
                        'udparcela_padron',
                        'persona_id',
                        'porc_dom',
                        'direccion_nomencla',
                        'indice',
                        'tipo_parce',
                        'estado_par',
                        'origen',
                        'barrio_id',
                        'ph',
                        'tipo_nomenclatura_id',
                        'expediente',
                        'matricula',
                        'union_desglose_id'
                        ];

    public $timestamps=false;

    public function parcela(){

        return $this->belongsTo('App\Parcela','parcela_id');
    }


}
