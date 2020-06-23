<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['client_id','amount','total_pay','payments_number','fee','ministry_date','due_date','finished'];

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }
    
    public function getSaldoAbonadoAttribute()
    {
        return $this->pagos()->sum('monto_recibido');
    }

    public function pagos(){
        return $this->hasMany('App\Models\Payment');
    }

    public function getSaldoPendienteAttribute()
    {
        $saldoPendiente = $this->pagos()->sum('cuota') - $this->saldoAbonado;
        return $saldoPendiente;
    }

    public function getPagosCompletadosAttribute()
    {
        return $this->pagos()->where('paid',1)->count();   
    }

}