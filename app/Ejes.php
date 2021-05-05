<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejes extends Model
{
    
    protected $table='gestion_direcciones.ejes_mendoza';

    protected  $primaryKey = 'eje_id';

    protected $fillable=[
                        'provincia_id',
                        'departamento_id',
                        'distrito_id',
                        'nombre'
                        ];

    public $timestamps=false;


}
