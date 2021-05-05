<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcelaServicio extends Model
{
    protected $table='parcelas_servicios';

    protected  $primaryKey = 'parcela_servicio_id';

    protected $fillable=[
                        'parcela_id',
                        'servicio_id',
                        'parcela_servicio_f_proce',
                        'usuario_id',
                        'estado_id'
                        ];

    public $timestamps=false;

    public function servicio(){

        return $this->belongsTo('App\TipoServicio','servicio_id','tipo_servicio_id');
    }
}
