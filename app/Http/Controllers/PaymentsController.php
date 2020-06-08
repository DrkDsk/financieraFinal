<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Loan;
use App\Models\Client;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments = Loan::orderBy('id')->get();
        
        return view('payments.index',[
            'payments' => $payments,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $pay = Payment::where('loan_id','=',$id)->select('payments.*')->count();
        $fecha = Payment::where('loan_id','=',$id)->select('payments.fecha_pago')->get()->last();

        if (!$fecha){
            $fecha = Loan::where('id','=',$id)->select('loans.ministry_date')->get();
            $fecha = $fecha[0]->ministry_date;
        } 
        else $fecha = $fecha->fecha_pago;

        $feeQuery = Loan::where('id','=',$id)->select('loans.fee')->get();
        $monto = intval($request->input('pay'));
        $cuota = intval($feeQuery[0]->fee);
        $fecha = Carbon::createFromFormat('Y-m-d',$fecha);

        $request->validate([
            'pay' => 'required|integer|numeric|gte:'.(int)$cuota,
        ]);
        
        if($monto % $cuota == 0) $veces = $monto / $cuota;
        else $veces = ($monto / $cuota) + 1;
        
        for($i=1; $i<=$veces; $i++){
            if($monto > $cuota) $pago = $cuota;
            else $pago = $monto;
            $monto = $monto - $cuota;

            Payment::create([
                'loan_id' => $id,
                'numero_pago' => $pay + $i,
                'cuota' => $cuota,
                'fecha_pago' => $fecha->add(1,'day'),
                'monto_recibido' => $pago,
            ]);
        }
        return redirect()->route('payments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('payments.pay',[
            'payment' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request -> validate([
            'amount' => 'required',
        ]);

        $payment = Payment::find($id);
        $payment->update($request->all());
        
        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
