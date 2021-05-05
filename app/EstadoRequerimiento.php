<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoRequerimiento extends Model
{
    protected $table='noticias_h_estados';

    protected  $primaryKey = 'not_h_est_id';

    protected $fillable=[
                        'not_h_desc',
                        'not_h_abrev',
                        'not_h_icono',
                        'not_h_orden'
                        ];

    public $timestamps=false;

    public function hilos(){

        return $this->hasMany('App\HiloRequerimiento','not_h_est_id');
    }
}
