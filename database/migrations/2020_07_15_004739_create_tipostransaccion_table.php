<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposTransaccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_tipostransaccion', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique();
            $table->string('tipo_transaccion');
            $table->integer('cargo_id')->unsigned()->nullable();
            $table->foreign('cargo_id')->references('cargo_id')->on('tr_cargos');
            $table->integer('estado_id')->unsigned()->nullable();
            $table->foreign('estado_id')->references('estado_id')->on('tr_estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_tipostransaccion');
    }
}
