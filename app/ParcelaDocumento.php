<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParcelaDocumento extends Model
{
    protected $table='parcelas_documentos';

    protected  $primaryKey = 'parcela_document_id';

    protected $fillable=[
                           'tipo_regimen_id',
                           'parcela_document_origen',
                           'parcela_document_f_origen',
                           'parcela_document_expediente',
                           'seccion_id',
                           'parcela_document_descrip',
                           'parcela_document_archivo',
                           'parcela_document_original',
                           'tipo_doc_id',
                           'parcela_id',
                           'parcela_document_f_proc',
                           'parcela_document_observaciones',
                           'usuario_id',
                           'tipo_estado',
                        ];

    public $timestamps=false;

   public function seccion(){
      return $this->belongsTo('App\Seccion','seccion_id');
   }
   public function tipo_documento(){
      return $this->belongsTo('App\TipoDocumentacion','tipo_doc_id');
   }
}