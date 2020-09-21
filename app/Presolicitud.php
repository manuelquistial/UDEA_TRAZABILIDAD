<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presolicitud extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_presolicitud';

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
        'id', 'usuario_id', 'consecutivo', 'valor', 'descripcion',
        'fecha_inicial', 'fecha_final', 'proyecto_id', 'transaccion_id',
        'estado_id', 'fecha_estado'
    ];
}
