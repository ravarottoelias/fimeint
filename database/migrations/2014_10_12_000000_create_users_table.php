<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('documento_tipo')->nullable();
            $table->string('documento_nro')->nullable();
            $table->string('cuit')->nullable();
            $table->string('profesion')->nullable();
            $table->string('pais')->nullable();
            $table->string('provincia')->nullable();
            $table->string('telefono')->nullable();
            $table->string('codigo_tel_pais')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
