<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('tr_usuarios', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->integer('cedula')->unique()->unsigned();
            $table->integer('telefono')->unsigned();
            $table->string('password');
            $table->integer('estado_id')->unsigned()->nullable();
            $table->foreign('estado_id')->references('estado_id')->on('tr_estados');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_usuarios');
    }
}
