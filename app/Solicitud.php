<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_solicitud';

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
        'id', 'consecutivo', 'encargado_id', 'centro_costos_id',
        'codigo_sigep_id', 'fecha_conveniencia', 'estado_id', 'fecha_estado', 'concepto'
    ];
}
