<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaRequerimiento extends Model
{
    protected $table='noticias_categoria';

    protected  $primaryKey = 'noti_cat_id';

    protected $fillable=[
                        'noti_cat_descr',
                        'noti_cat_abrev',
                        'noti_cat_icono',
                        'noti_h_est_id'
                        ];

    public $timestamps=false;

    public function estado(){

        return $this->belongsTo('App\EstadoRequerimiento','noti_h_est_id');
    }

    public function noticias(){

        return $this->hasMany('App\Requerimiento');
    }

}
