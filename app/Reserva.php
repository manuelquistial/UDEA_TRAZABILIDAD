<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_reserva';

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
        'id', 'encargado_id', 'consecutivo', 'num_oficio', 'fecha_cancelacion',
        'estado_id', 'fecha_estado'
    ];
}
