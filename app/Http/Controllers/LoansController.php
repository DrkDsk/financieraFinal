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
        //
        $loans = Loan::all();
        $clientes = Client::all();
        return view ('loans.index',[
            'loans' => $loans,
            'clients' => $clientes,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loans.create');
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
            'name'  => 'required',
            'amount' => 'required',
            'payments_number' => 'required',
            'fee' => 'required',
            'ministry_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
        ]);

        $client = Client::where('name',$request->input('name'))->exists();
        
        if($client){
            Loan::create([
                'amount' => $request->input('amount'),
                'payments_number' => $request->input('payments_number'),
                'fee' => $request->input('fee'),
                'ministry_date' => $request->input('ministry_date'),
                'due_date' => $request->input('due_date'),
            ]);
        }
        else{
            return "No se encontró el cliente";
        }
        

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
