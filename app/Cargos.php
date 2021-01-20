<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;

class Cargos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_cargos';

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
        'id', 'cargo', 'cargo_id', 'habilitador'
    ];

    public function usuario(){
        return $this->belongsToMany(Usuario::class, 'tr_usuarios_cargos', 'cargo_id', 'usuario_id');
    }

    public function usuarioByCargo($cargo_id){
        return $this->usuario()
                ->orWherePivot('cargo_id','=',$cargo_id)
                ->where('tr_usuarios.estado_id','=', 4)
                ->select('nombre_apellido','email');
    }
}
