<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\TiposTransaccion;
use App\Cargos;
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
        'nombre_apellido', 'email', 'telefono', 'cedula', 'password', 'estado_id'
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

    public function cargo(){
        return $this->belongsToMany(Cargos::class, 'tr_usuarios_cargos', 'usuario_id', 'cargo_id');
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
    * Check one cargo
    * @param string $cargos
    */
    public function hasOneCargo($cargo_id){
        return null !== $this->cargo()->where('tr_cargos.cargo_id', $cargo_id)->first();
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

    /**
    * Check if tipo de transaccion have an usuario
    * @param string $tipoTransaccion
    */
    public function tipoTransaccionWithUsuarios(){
        return $this->tiposTransaccion()
                ->orWherePivot('usuario_id','!=',NULL)
                ->where('estado_id','=', 4)
                ->select('tr_tipostransaccion.id','tr_tipostransaccion.tipo_transaccion');
    }

    /**
    * Check if tipo de transaccion have an usuario
    * @param string $tipoTransaccion
    */
    public function tipoTransaccionWithOutUsuarios(){
        $ids = array();
        foreach($this->tipoTransaccionWithUsuarios()->get() as $value){
            array_push($ids, $value['id']);
        }
        return TiposTransaccion::whereNotIn('id', $ids);
    }
}
