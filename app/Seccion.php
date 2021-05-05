<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    protected $table='secciones';

    protected  $primaryKey = 'seccion_id';

    protected $fillable=[
                        'seccion_descrip',
                        'afectacion',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;

    public function users(){

        return $this->hasMany('App\User');
    }
}
