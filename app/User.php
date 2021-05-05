<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='usuarios';

    protected $primaryKey = 'usuario_id';

    protected $connection = 'mysql';

    protected $fillable = [
        'usuario_nombre',
        'tipo_documento',
        'num_documento',
        'email', 
        'usuario_login',
        'password',
        'condicion',
        'idrol',
        'idseccion',
        'imagen'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rol(){

        return $this->belongsTo('App\Rol','idrol');
    }

    public function seccion(){

        return $this->belongsTo('App\Seccion','idseccion');
    }

    public function bloqueos(){

        return $this->hasMany('App\Bloqueo');
    }

    public function hilos(){

        return $this->hasMany('App\HiloRequerimiento','usuario_id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
