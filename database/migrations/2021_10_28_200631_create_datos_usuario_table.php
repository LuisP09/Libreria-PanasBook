<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('rfc');
            $table->string('razon_social');
            $table->string('calle');
            $table->string('no_ext');
            $table->string('no_int');
            $table->string('cp');
            $table->bigInteger('id_usuario');

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_usuario');
    }
}
