<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposTransaccion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_tipostransaccion';

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
        'id', 'tipo_transaccion', 'etapa_id', 'estado_id'
    ];
}
