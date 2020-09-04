<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsecutivoEtapaEstado extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_consecutivo_etapa_estado';

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
        'id', 'consecutivo', 'etapa_id', 'estado_id', 'fecha_estado'
    ];
}
