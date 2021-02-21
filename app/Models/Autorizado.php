<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autorizado extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_autorizado';

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
        'id', 'encargado_id', 'consecutivo', 'codigo_sigep', 'pendiente_codigo_sigep', 'descripcion_pendiente',
        'estado_id', 'fecha_estado', 'enviado'
    ];
}
