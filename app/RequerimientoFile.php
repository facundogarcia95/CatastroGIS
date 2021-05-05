<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimientoFile extends Model
{
    protected $table='noticia_hilos_file';

    protected  $primaryKey = 'noticia_hilos_file_id';

    protected $fillable=[
                        'noticia_hilo_id',
                        'file_name',
                        'file_datetime',
                        'usuario_id'
                        ];

    public $timestamps=false;

    public function hilo(){

        return $this->belongsTo('App\HiloRequerimiento','noticia_hilo_id');
    }

    public function extension($file_name){

        $arreglo = explode(".",$file_name);

        $extension = end($arreglo);
        
        return $extension;
    }

   
}
