<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('descripcion');
            $table->text('contenido');
            $table->string('lugar');
            $table->string('link_mp')->text()->nullable();
            $table->string('foto')->nullable();
            $table->integer('categoria_id')->unsigned();
            $table->string('slug');
            $table->string('estado')->nullable();
            $table->boolean('permitir_inscripcion')->default(0);
            $table->integer('cantidad_cuotas')->default(1);
            $table->string('token')->nullable();
            $table->float('unit_price')->nullable();
            $table->boolean('publicado')->default(false);
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('cursos');
    }
}
