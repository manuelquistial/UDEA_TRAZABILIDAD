<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAprobadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('tr_aprobado', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('consecutivo')->unsigned();
            $table->integer('encargado_id')->unsigned();
            $table->foreign('encargado_id')->references('cedula')->on('tr_usuarios');
            $table->date('fecha_envio_documento')->nullable();
            $table->date('fecha_envio_decanatura')->nullable();
            $table->date('fecha_envio_presupuestos')->nullable();
            $table->string('solpe')->nullable();
            $table->string('crp')->nullable();
            $table->date('fecha_crp_pedido')->nullable();
            $table->string('valor_final_crp')->nullable();
            $table->string('nombre_tercero')->nullable();
            $table->integer('identificacion_tercero')->unsigned()->nullable();
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('estado_id')->on('tr_estados');
            $table->dateTime('fecha_estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_aprobado');
    }
}
