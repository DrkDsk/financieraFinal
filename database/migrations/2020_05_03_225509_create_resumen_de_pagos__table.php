<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumenDePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumen_de_pagos_', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->integer('montoSuministrado');
            $table->integer('financiado');
            $table->date('fechaMinistrado');
            $table->date('fechaVencimiento');
            $table->integer('cuota');
            $table->integer('noPagos');
            $table->integer('pagosRealizados');
            $table->integer('abonado');
            $table->integer('saldoPendiente');

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
        Schema::dropIfExists('resumen_de_pagos_');
    }
}
