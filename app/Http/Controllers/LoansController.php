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
            'amount' => 'required',
            'payments_number' => 'required',
            'fee' => 'required',
            'ministry_date' => 'required',
            'due_date' => 'required',
        ]);


        Loan::create([
                'client_id' => $request->input('client_id'),
                'amount' => $request->input('amount'),
                'payments_number' => $request->input('payments_number'),
                'fee' => $request->input('fee'),
                'ministry_date' => $request->input('ministry_date'),
                'due_date' => $request->input('due_date'),
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
