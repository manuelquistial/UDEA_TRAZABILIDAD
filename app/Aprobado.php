<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aprobado extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_aprobado';

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
        'id', 'encargado_id', 'consecutivo', 'fecha_crp_pedido', 'crp', 'valor_final_crp', 'nombre_tercero', 'identificacion_tercero',
        'estado_id', 'fecha_estado', 'fecha_envio_documento', 'fecha_envio_decanatura', 'fecha_envio_presupuestos'
    ];
}
