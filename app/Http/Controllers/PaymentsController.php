<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Loan;
use App\Models\Client;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    
    public function index()
    {
        $payments = Loan::orderBy('id')->get();
        return view('payments.index',[
            'payments' => $payments,
        ]);
    }

    public function create($id)
    {   
        $abonado = Payment::where('loan_id','=',$id)->select('payments.monto_recibido')->get();
        $consultaTotal = Loan::where('id','=',$id)->select
        ('loans.total_pay','loans.fee','loans.payments_number','loans.ministry_date','loans.due_date')->get();
        
        $suma = Payment::where('loan_id','=',$id)->sum('monto_recibido');
        $pagos = Payment::where('loan_id','=',$id)->select('payments.numero_pago','payments.monto_recibido','payments.cuota','payments.fecha_pago')->get();
        
        $total = $consultaTotal[0]->total_pay;
        $cuota = $consultaTotal[0]->fee;
        $pendiente = $total - $suma;

        $loan = Loan::find($id)->total_pay;

        if($suma == $loan){
            $loan = Loan::find($id);
            $loan->finished = 1;
            $loan->save();
        }
        
        $payment = array(
            'id' => $id,
            'abonado' => $suma,
            'pendiente' => $pendiente,
            'cuota' => $cuota,
        );

        return view('payments.pay',[
            'payment' => $payment,
            'pagos' => $pagos,
        ]);
    }

    public function store(Request $request, $id)
    {
        $cuota = Loan::find($id)->fee;
        $total = Loan::find($id)->total_pay;
        $montoPendiente = Payment::where('loan_id','=',$id)->sum('monto_recibido');
        $total = $total - $montoPendiente;

        $request->validate([
            'pay' => "required|integer|numeric|between:$cuota,$total",
        ]);
        
        $fechaPago = Payment::where('loan_id','=',$id)->select('payments.fecha_pago')->get()->first();
        
        $fechaPago = $fechaPago->fecha_pago;
        $fechaPago = Carbon::createFromDate($fechaPago);

        $monto = intval($request->input('pay'));
        if($monto % $cuota == 0) $veces = $monto / $cuota;
        else $veces = ($monto / $cuota) + 1;
        
        $datos = Payment::where('loan_id','=',$id)->get();
        
        for($i=1; $i<=$veces; $i++){
            if($monto > $cuota) $pago = $cuota;
            else $pago = $monto;
            $monto = $monto - $cuota;
            
            $payment = new Payment();
            $payment->loan_id = $datos[$i-1]->loan_id;
            $payment->numero_pago = $i;
            $payment->cuota = $datos[$i-1]->cuota;
            $payment->fecha_pago = $datos[$i-1]->fecha_pago;
            $payment->monto_recibido = $pago;
            $payment->save();
        }
        return redirect()->route('payments.index');
    }

    public function show($id)
    {
        //

    }

    public function edit($id)
    {
        return view('payments.pay',[
            'payment' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $request -> validate([
            'amount' => 'required',
        ]);

        $payment = Payment::find($id);
        $payment->update($request->all());
        
        return redirect()->route('payments.index');
    }

    public function destroy($id)
    {
        
    }
}
