<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScriptDePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('script_de_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->text('script');
            $table->text('descripcion')->nullable();
            $table->integer('curso_id')->unsigned();
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
        Schema::dropIfExists('script_de_pagos');
    }
}
