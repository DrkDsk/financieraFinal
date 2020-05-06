<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    //
    protected $table = 'prestamos';

    protected $fillable = ['cliente','montoSuministrado','noPagos','cuota','total_a_pagar','fechaMinistracion','fechaVencimiento'];
}