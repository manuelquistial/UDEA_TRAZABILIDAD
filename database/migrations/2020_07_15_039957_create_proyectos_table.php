<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_proyectos', function (Blueprint $table) {
            $table->increments('id')->unsigned()->unique();
            $table->string('proyecto');
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
        Schema::dropIfExists('tr_proyectos');
    }
}
