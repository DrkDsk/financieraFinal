<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumenPagos extends Model
{
    //
    protected $table = 'resumen_de_pagos_';

    protected $fillable = ['cliente','montoSuministrado','financiado','fechaMinistrado','fechaVencimiento','cuota','noPagos','pagosRealizados','abonado','saldoPendiente'];
}