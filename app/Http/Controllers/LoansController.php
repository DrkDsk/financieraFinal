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
        
        $loans = Loan::orderBy('client_id','ASC')->get();
        $clients = Client::join('loans','clients.id','=','loans.client_id')->select('clients.name')->get();
        
        return view ('loans.index',[
            'loans' => $loans,
            'clients' => $clients,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $clients = Client::all();
        return view('loans.create',[
            "clients" => $clients,
        ]);
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
            'cantidad' => 'required|numeric',
            'porcentaje' => 'required|numeric',
            'número_de_pagos' => 'required|numeric',
            'cuota' => 'required|numeric',
            'fecha_de_ministro' => 'required',
            'fecha_de_vencimiento' => 'required',
        ]);

        $cantidad = intval($request->input('cantidad'));    
        $porcentaje = (intval($request->input('porcentaje'))/100)*$cantidad;
        $total = $porcentaje+$cantidad;

        return $total;
        
        /*
        Loan::create([
                'client_id' => $request->input('client_id'),
                'amount' => $cantidad,
                'total_pay' => $total,
                'payments_number' => intval($request->input('número_de_pagos')),
                'fee' => intval($request->input('cuota')),
                'ministry_date' => $request->input('fecha_de_ministro'),
                'due_date' => $request->input('fecha_de_vencimiento'),
            ]);
        
        return redirect()->route('loans.index');
        */
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
        $loan = Loan::find($id);
        $loan->delete();
        return $loan;
    }
}
