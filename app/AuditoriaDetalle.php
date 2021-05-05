<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditoriaDetalle extends Model

{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='auditorias_detalle';

    protected $primaryKey = 'auditoria_det_id';

    protected $connection = 'mysql';

    protected $fillable = [
        'auditoria_det_campo', 
        'auditoria_det_old', 
        'auditoria_det_new', 
        'auditoria_det_descripcion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
