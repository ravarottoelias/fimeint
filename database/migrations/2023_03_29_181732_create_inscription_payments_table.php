<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscription_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inscription_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('payment_identifier');
            $table->string('amount');
            $table->string('gateway');
            $table->string('payload');
            $table->string('status');
            $table->string('payment_date');
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
        Schema::dropIfExists('inscription_payments');
    }
}
