<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcelasBusquedaDinamica extends Model
{
    //
    protected  $primaryKey = 'nomencla21';

    protected $connection = 'pgsql';

    protected $table='parcelas_busqueda_dinamica';

    protected $fillable=[
      'nomencla21',
      'usuario_id'
     ];
     
     public $timestamps=false;

}