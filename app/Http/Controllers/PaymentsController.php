<?php

namespace App\Http\Controllers;

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
        //monto recibido
        $abonado = Payment::where('loan_id','=',$id)->select('payments.monto_recibido')->get();
        //total del prestamo
        $consultaTotal = Loan::where('id','=',$id)->select('loans.total_pay','loans.fee')->get();
        $total = $consultaTotal[0]->total_pay;
        $cuota = $consultaTotal[0]->fee;
        
        $a = 0;
        foreach($abonado as $abono){
            $a = $a + intval($abono->monto_recibido);
        }
        //crear una estructura de datos donde vaya: id del prestamo,saldo abonado,saldo pendiente, cuota
        //y devolver a la vista payments.pay
        $pendiente = $total - $a;

        $payment = array(
            'id' => $id,
            'saldo_abonado' => $a,
            'pendiente' => $pendiente,
            'fee' => $cuota,
        ); 

        return view('payments.pay',[
            'payment' => $payment,
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
        $feeQuery = Loan::where('id','=',$id)->select('loans.fee')->get();

        $request->validate([
            'pay' => 'required|integer',
        ]);
        
        Payment::create([
            'loan_id' => $id,
            'numero_pago' => $pay+1,
            'cuota' => intval($feeQuery[0]->fee),
            'fecha_pago' => '2020-05-11',
            'monto_recibido' => $request->input('pay'),
        ]);
        

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
