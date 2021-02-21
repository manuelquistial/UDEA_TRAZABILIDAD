<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActualEtapaEstado extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_actual_etapa_estado';

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
