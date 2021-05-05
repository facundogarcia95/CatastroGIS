<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Requerimiento extends Model
{
    protected $table='noticias';

    protected  $primaryKey = 'noticia_id';

    protected $fillable=[
                        'noti_cat_id',
                        'noticia_asunto',
                        'noticia_created',
                        'noticia_update',
                        'usuario_id',
                        'estado',
                        ];

    public $timestamps=false;

    public function user(){

        return $this->belongsTo('App\User','usuario_id');
    }

    public function estado(){

        return EstadoRequerimiento::where('not_h_est_id','=',$this->estado)->first();

    }

    public function categoria(){

        return $this->belongsTo('App\CategoriaRequerimiento','noti_cat_id');
    }

    public function hilos(){

        return $this->hasMany('App\HiloRequerimiento','noticia_id');
    }

    public function ultimoHilo()
    {
        return HiloRequerimiento::where('noticia_id','=',$this->noticia_id)->orderBy('noti_hilo_fecha','DESC')->first();
    }

    public function asignados(){

        return RequerimientoAsignado::where('requerimiento','=',$this->noticia_id)->get();
    }
}
