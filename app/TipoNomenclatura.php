<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoNomenclatura extends Model
{
    protected $table='tipos_nomenclaturas';

    protected  $primaryKey = 'tipo_nomenclatura_id';

    protected $fillable=[
                        'tipo_nomenclatura_descrip',
                        'tipo_nomenclatura_descrip_ext',
                        'tipo_nomenclatura_etiqueta',
                        'tipo_nomenclatura_valor',
                        ];

    public $timestamps=false;

    public function parcelas(){

        return $this->hasMany('App\Parcela','tipo_nomenclatura');
    }
}
