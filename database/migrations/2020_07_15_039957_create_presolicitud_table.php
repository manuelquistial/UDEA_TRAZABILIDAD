<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_presolicitud', function (Blueprint $table) {
            $table->increments('consecutivo', 1000)->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('cedula')->on('tr_usuarios');
            $table->integer('encargado_id')->unsigned()->nullable();
            $table->foreign('encargado_id')->references('cedula')->on('tr_usuarios');
            $table->integer('proyecto_id')->unsigned();
            $table->string('otro_proyecto')->nullable();
            $table->integer('transaccion_id')->unsigned();
            $table->foreign('transaccion_id')->references('id')->on('tr_tipostransaccion');
            $table->date('fecha_inicial')->nullable();
            $table->date('fecha_final')->nullable();
            $table->integer('valor');
            $table->string('descripcion');
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
        Schema::dropIfExists('tr_presolicitud');
    }
}
