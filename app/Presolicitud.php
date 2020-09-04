<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presolicitud extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_presolicitud';

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
        'id', 'consecutivo', 'valor', 'descripcion_pendiente',
        'fecha_inicial', 'fecha_final', 'proyecto_id', 'transaccion_id',
        'etapa_id', 'fecha_estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];
}
