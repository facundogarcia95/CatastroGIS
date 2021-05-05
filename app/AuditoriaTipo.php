<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditoriaTipo extends Model

{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='auditorias_tipos';

    protected $primaryKey = 'aud_tip_id';

    protected $connection = 'mysql';

    protected $fillable = [
        'aud_tip',
        'aud_tip_abrev'
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
