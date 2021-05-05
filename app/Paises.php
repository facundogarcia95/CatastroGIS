<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    
    protected $table='paises';

    protected  $primaryKey = 'pais_id';

    protected $fillable=[
                     'pais_nombre'
                        ];

    public $timestamps=false;


}
