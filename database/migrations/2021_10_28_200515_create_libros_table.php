<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('anio');
            $table->string('no_pagina')->nullable();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('url_imagen');
            $table->string('precio');
            $table->bigInteger('id_autor');
            $table->bigInteger('id_categoria');


            $table->foreign('id_autor')->references('id')->on('autor');
            $table->foreign('id_categoria')->references('id')->on('categorias');

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
        Schema::dropIfExists('libros');
    }
}
