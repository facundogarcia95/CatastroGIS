<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimientoAsignado extends Model
{
    protected $table='requerimientos_asignados';

    protected $fillable=[
                        'requerimiento',
                        'usuario_id'
                        ];

    public $timestamps=false;


    public function user(){

        return $this->belongsTo('App\User','usuario_id');
    }

}
