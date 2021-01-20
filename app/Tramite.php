<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_tramite';

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
        'id', 'encargado_id', 'consecutivo', 'fecha_sap', 'consecutivo_sap',
        'estado_id', 'fecha_estado'
    ];
}
