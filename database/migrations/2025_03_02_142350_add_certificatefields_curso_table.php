<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCertificatefieldsCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cursos', function (Blueprint $table) {
            // $table->string('total_hs')->nullable();
            // $table->string('fecha_inicio')->nullable();
            // $table->string('fecha_fin')->nullable();
            // $table->string('curso_homologacion')->nullable();
            $table->text('cuerpo_certificado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->dropColumn('total_hs');
            $table->dropColumn('fecha_inicio');
            $table->dropColumn('fecha_fin');
        });
    }
}
