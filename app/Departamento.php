<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected  $primaryKey = 'departamento_id';

    protected $connection = 'mysql2';

    protected $table='departamentos';

    protected $fillable=[
       'provincia_id',
       'departamento_nombre',
       'departamento_abrev'
      ];

      public function departamento(){

        return $this->belongsTo('App\Provincia','provincia_id');

    }
}