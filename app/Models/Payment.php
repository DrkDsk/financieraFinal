<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['loan_id','numero_pago','cuota','fecha_pago','monto_recibido'];
}