<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //
    protected  $primaryKey = 'provincia_id';

    protected $connection = 'mysql2';

    protected $table='provincias';

    protected $fillable=[
       'provincia_nombre',
       'provincia_abrev',
       'abrev_iso'
      ];

}