<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Loan;
use App\Models\Payment;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $numeroClients = Client::all()->count();
        $numeroPrestamos = Loan::all()->count();
        $numeroPagos = Payment::all()->where('monto_recibido','>','0')->count();
        return view('home',[
            'numeroClientes' => $numeroClients,
            'numeroPrestamos' => $numeroPrestamos,
            'numeroPagos' => $numeroPagos
        ]);
    }
}