<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::join('clients','loans.client_id','=','clients.id')->select('loans.*','clients.name')->get();
        return view ('loans.index',[ 'loans' => $loans,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('loans.create',[ "clients" => $clients,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        
        Loan::create([
                'client_id' => $request->input('client_id'),
                'amount' => intval($request->input('cantidad')),
                'total_pay' => $total,
                'payments_number' => intval($request->input('número_de_pagos')),
                'fee' => intval($request->input('cuota')),
                'ministry_date' => $request->input('fecha_de_ministro'),
                'due_date' => $request->input('fecha_de_vencimiento'),
            ]);
        
        return redirect()->route('loans.index');
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
        return view('loans.edit',[
            'loan' => $id
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = Loan::find($id);
        $loan->delete();
        return $loan;
    }
}
