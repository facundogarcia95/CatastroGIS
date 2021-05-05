<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //
    protected $table='uso_eventos_usuario';

    protected  $primaryKey = 'id';

    protected $fillable=['fecha','ruta','usuario_id'];
    
    public $timestamps=false;

    public function user(){

        return $this->belongsTo('App\User','usuario_id');
    }

}
