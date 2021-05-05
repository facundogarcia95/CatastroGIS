<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table='grupos';

    protected  $primaryKey = 'grupo_id';

    protected $fillable=['grupo_nombre','tipo_estado_id'];
    
    public $timestamps=false;

    public function users(){

        return $this->hasMany('App\User','idrol');
    }

}
