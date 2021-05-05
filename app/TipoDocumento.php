<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table='tipos_documentos';

    protected  $primaryKey = 'tipo_documento_id';

    protected $fillable=[
                        'tipo_documento_descrip',
                        'tipo_documento_abrev',
                        'tipo_estado_id'
                        ];

    public $timestamps=false;
}
