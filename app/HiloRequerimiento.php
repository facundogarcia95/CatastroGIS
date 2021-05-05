<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HiloRequerimiento extends Model
{
    protected $table='noticias_hilos';

    protected  $primaryKey = 'noti_hilo_id';

    protected $fillable=[
                        'noticia_id',
                        'noti_hilo_fecha',
                        'noti_hilo_texto',
                        'usuario_id',
                        'not_h_est_id'
                        ];

    public $timestamps=false;

    public function user(){

        return $this->belongsTo('App\User','usuario_id');
    }

    public function noticia(){

        return $this->belongsTo('App\Requerimiento','noticia_id');
    }

    public function estado(){

        return $this->belongsTo('App\EstadoRequerimiento','not_h_est_id');
    }

    public function archivos(){

        return $this->hasMany('App\RequerimientoFile','noticia_hilo_id');
    }

}
