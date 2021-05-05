<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    //
    protected  $primaryKey = 'distrito_id';

    protected $connection = 'mysql2';

    protected $table='distritos';

    protected $fillable=[
       'departamento_id',
       'distrito_nombre',
       'distrito_abrev'
      ];



}