<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentacion extends Model
{
    protected $table='tipos_documentacion';

    protected  $primaryKey = 'tipo_doc_id';

    protected $fillable=[
                        'tipo_doc_descrip'
                        ];

    public $timestamps=false;
}


