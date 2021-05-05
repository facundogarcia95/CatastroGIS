<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarrioMigracion extends Model
{
    //
    protected  $primaryKey = 'gid';

    protected $connection = 'pgsql';

    protected $table='barrios_las_heras';

    protected $fillable=[
       'barrio_id',
       'barrio',
       'municipio',
       'distrito',
       'geom'
     ];
     
     public $timestamps=false;

}