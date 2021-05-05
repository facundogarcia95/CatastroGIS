<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloqueo extends Model
{
    protected $table='uso_session';

    protected $fillable=[
                        'parcela_id',
                        'usuario_id',
                        'descrip',
                        'fecha'
                        ];

    public $timestamps=false;

    public function user(){
        return $this->belongsTo('App\User','usuario_id');
    }

    public function parcela(){
        return $this->belongsTo('App\Parcela','parcela_id');
    }
}
