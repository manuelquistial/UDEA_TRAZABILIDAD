<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\TiposTransaccion;
use App\Etapa;
use App\Roles;

class Usuario extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_usuarios';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellidos', 'email', 'telefono', 'cedula', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tiposTransaccion(){
        return $this->belongsToMany(TiposTransaccion::class, 'tr_usuarios_tipostransaccion', 'usuario_id', 'tipo_transaccion_id')->orderBy('tipo_transaccion', 'asc');
    }

    public function etapa(){
        return $this->belongsToMany(Etapa::class, 'tr_usuarios_etapas', 'usuario_id', 'etapa_id');
    }

    public function role(){
        return $this->belongsToMany(Roles::class, 'tr_usuarios_roles', 'usuario_id', 'role_id');
    }

    /**
    * Check one role
    * @param string $role
    */
    public function hasOneRole($role){
        return null !== $this->role()->where('role', $role)->first();
    }

    /**
    * Check one etapa
    * @param string $etapas
    */
    public function hasOneEtapa($etapa_id){
        return null !== $this->etapa()->where('tr_etapas.etapa_id', $etapa_id)->first();
    }

    /**
    * Check specific etipo transaccion
    * @param string $transaccion
    */
    public function hasOneTipoTransaccion($transaccion_id){
        return null !== $this->tiposTransaccion()->where('tipo_transaccion_id', $transaccion_id)->first();
    }

    /**
    * Check one tipo de transaccion
    * @param string $tipoTransaccion
    */
    public function hasTipoTransaccion(){
        return null !== $this->tiposTransaccion()->first();
    }
}
