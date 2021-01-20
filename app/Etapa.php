<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_etapas';

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
        'id', 'etapa', 'endpoint', 'etapa_id', 'habilitador'
    ];
}
