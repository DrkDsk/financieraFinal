<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    
    public function index()
    {
        $loans = Loan::join('clients','loans.client_id','=','clients.id')->select('loans.*','clients.name')->get();
        return view ('loans.index',[ 'loans' => $loans,]);
    }

    public function create()
    {
        $clients = Client::all();
        return view('loans.create',[ "clients" => $clients,]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'client_id' => 'required',
            'cantidad' => 'required|integer',
            'porcentaje' => 'required|integer',
            'número_de_pagos' => 'required|integer',
            'cuota' => 'required|integer',
            'fecha_de_ministro' => 'required',
            'fecha_de_vencimiento' => 'required',
        ]);

        $cantidad = intval($request->input('cantidad'));    
        $porcentaje = (intval($request->input('porcentaje'))/100)*$cantidad;
        $total = $porcentaje+$cantidad;

        $prestamo = new Loan();
        $prestamo->client_id = $request->input('client_id');
        $prestamo->amount = intval($request->input('cantidad'));
        $prestamo->total_pay = $total;
        $prestamo->payments_number = intval($request->input('número_de_pagos'));
        $prestamo->fee = intval($request->input('cuota'));
        $prestamo->ministry_date = $request->input('fecha_de_ministro');
        $prestamo->due_date = $request->input('fecha_de_vencimiento');
        $prestamo->save();

        $noPagos = intval($request->input('número_de_pagos'));
        $pago = 0;
        $fechaPago = Carbon::createFromDate($request->input('fecha_de_ministro'));
        
        while($pago < $prestamo->payments_number){
            $fechaPago -> addDay();
            if($fechaPago->isWeekDay()){
                $payment = new Payment();
                $payment->loan_id = $prestamo->id;
                $payment->numero_pago = $pago+1;
                $payment->cuota = intval($request->input('cuota'));
                $payment->fecha_pago = $fechaPago;
                $payment->monto_recibido = 0;
                $payment->save();
                $pago++;
            }
        }
        
        return redirect()->route('loans.index');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        return view('loans.edit',[
            'loan' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer',
            'porcentaje' => 'required|integer',
            'numero_de_pagos' => 'required|integer',
            'cuota' => 'required|integer',
            'fecha_de_ministro' => 'required',
            'fecha_de_vencimiento' => 'required',
        ]);

        $cantidad = intval($request->input('cantidad'));    
        $porcentaje = (intval($request->input('porcentaje'))/100)*$cantidad;
        $total = $porcentaje+$cantidad;

        $loan = Loan::find($id);
        $loan->amount = $request->cantidad;
        $loan->total_pay = $total;
        $loan->payments_number = $request->numero_de_pagos;
        $loan->fee = $request->cuota;
        $loan->ministry_date = $request->fecha_de_ministro;
        $loan->due_date = $request->fecha_de_vencimiento;
        $loan->save();
        return redirect()->route('loans.index');
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);
        $loan->delete();
        return $loan;
    }
}
