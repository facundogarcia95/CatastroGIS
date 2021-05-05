<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoParcela extends Model
{
    protected $table='tipos_parcelas';

    protected  $primaryKey = 'tipo_parcela_id';

    protected $fillable=[
                        'tipo_parcela_descrip',
                        'tipo_parcela_abrev'
                        ];

    public $timestamps=false;
}
