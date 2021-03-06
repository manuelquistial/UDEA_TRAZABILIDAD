<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_pago';

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
        'id', 'encargado_id', 'consecutivo', 
        'estado_id', 'fecha_estado'
    ];
}
