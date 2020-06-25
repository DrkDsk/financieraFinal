<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Imports\ImportarCliente;
use Maatwebsite\Excel\Facades\Excel;

class ClientsController extends Controller
{
    
    public function index()
    {
        $clients = Client::all();
        return view('clients.index',[
            'clients' => $clients,
        ]);
    }
    
    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Client::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('clients.index');

    }

    public function show($id)
    {
        //
    }

    
    public function edit(Client $id)
    {
        //
        return view('clients.edit',[
            'client' => $id
        ]);
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);
        
        $file = $request->file('file');
        Excel::import(new ImportarCliente, $file);
        
        return back()->with('message','importación de usuarios completada');
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $client = Client::find($id);
        $client->update($request->all());

        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return $client;
    }
}
