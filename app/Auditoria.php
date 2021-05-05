<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table='auditorias';

    protected  $primaryKey = 'auditoria_id';

    protected $fillable=[
                        'auditoria_script',
                        'auditoria_host',
                        'aud_tip_id',
                        'usuario_id',
                        'auditoria_fecha',
                        'auditoria_tabla',
                        'auditoria_registro_id',
                        'auditoria_descripcion',
                        'auditoria_detalle_old',                                
                        'auditoria_detalle_new'                                
                        ];

    public $timestamps=false;

    public function usuario(){
        return $this->belongsTo('App\User','usuario_id', 'usuario_id');
    } 

    public function tipos(){
        return $this->belongsTo('App\AuditoriaTipo','aud_tip_id', 'aud_tip_id');
    } 


}
