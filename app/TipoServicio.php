<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    protected $table='tipos_servicios';

    protected  $primaryKey = 'tipo_servicio_id';

    protected $fillable=[
                        'tipo_servicio_descrip',
                        'tipo_servicio_abrev',
                        'tipo_servicio_coef',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;

    public function parcelas_servicio(){

        return $this->hasMany('App\ParcelaServicio','servicio_id');
    }
}
