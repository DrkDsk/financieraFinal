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
        $recibido = Payment::where('loan_id','=',$id)->sum('monto_recibido');
        $pendiente = $total - $recibido;

        if($cuota > $pendiente){
            $request->validate([
                'pay' => "required|integer|numeric|max:$pendiente",
            ]);
        }
        else{
            $request->validate([
                'pay' => "required|integer|numeric|between:$cuota,$pendiente",
            ]);
        }
        
        $pagos = Payment::all()->where('loan_id','=',$id);
        $ultimoAbono = Payment::where('loan_id','=',$id)->select('monto_recibido')->get()->last();
        $ultimoAbono = $ultimoAbono->monto_recibido;
        
        $ultimoPago = Payment::where('loan_id','=',$id)->select('numero_pago')->get()->last();
        
        
        $ultimoPago = $ultimoPago->numero_pago;
        $monto = intval($request->input('pay'));
        
        foreach($pagos as $pago){

            if($monto > $pago->cuota && $pago->numero_pago != $ultimoPago){
                if($pago->monto_recibido == 0){
                    $pago->monto_recibido = $pago->cuota;
                    $pago->save();
                    $monto = $monto - $cuota;
                }
                //representa el abono del ultimo pago
                elseif($monto > $pago->cuota && $pago->numero_pago == $ultimoPago){
                    $pago->monto_recibido = $monto;
                    $pago->save();
                break;
                }
            }
            elseif($monto == $cuota){
                if($pago->monto_recibido == 0){
                    $pago->monto_recibido = $monto;
                    $pago->save();
                    //representa un solo pago
                    break;   
                }
            } 
            else{
                if($pago->monto_recibido == 0){
                    $pago->monto_recibido = $monto;
                    $pago->save();
                    $monto = 0;
                }
                elseif($pago->numero_pago == $ultimoPago && $pago->monto_recibido !=0){
                    $abono = $ultimoAbono + intval($request->input('pay'));
                    $pago->monto_recibido = $abono;
                    $pago->save();
                }
            } 
        }
        return redirect()->route('payments.create',$id);
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
