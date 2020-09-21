<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroCostos extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_centro_costos';

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
        'id', 'centro_costo', 'estado_id',
    ];
}
