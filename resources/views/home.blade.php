@extends('layouts.nav')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">
                        <h2>Número de Clientes</h2>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="h1">{{$numeroClientes}}</p>
                            <span class="material-icons" style="font-size: 50px">
                                group
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">
                        <h3>Número de Préstamos</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="h1">{{$numeroClientes}}</p>
                            <span class="material-icons" style="font-size: 50px">
                                price_change
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-dark bg-warning mb-3">
                    <div class="card-header">
                        <h3>Número de Pagos</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="h1">{{$numeroClientes}}</p>
                            <span class="material-icons" style="font-size: 50px">
                                paid
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
