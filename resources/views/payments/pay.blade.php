@extends('layouts.nav')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="form-group col-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="mb-1">Detalles</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div>
                                    <p>Saldo Abonado: ${{$payment['abonado']}}</p>
                                </div>

                                <div>
                                    <p>Saldo Pendiente: ${{$payment['pendiente']}}</p>
                                </div>

                                <div>
                                    <p>Cuota: ${{$payment['cuota']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>

            <div class="col-md-6 mx-center">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="mb-1">Abonos</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No.</th>
                                    <th scope="col">cuota</th>
                                    <th scope="col">Abonado</th>
                                    <th scope="col">Fecha de Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagos as $pago)
                                <tr class="text-center">
                                    <td scope="row">{{$pago->numero_pago}}</td>
                                    <td scope="row">{{$pago->cuota}}</td>
                                    <td scope="row">{{$pago->monto_recibido}}</td>
                                    <td scope="row">{{$pago->fecha_pago}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$pagos->links()}}
                    </div>
                </div>
            </div>

            @if($payment['pendiente'])
            <div class="col-md-3 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="mb-0">Nuevo Pago</h3>
                            </div>
                            <div>
                                <a href="{{route('payments.index')}}" class="btn btn-danger">
                                    {{__('Cancel')}}
                                </a>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card-body">
                        <form action="{{route('payments.store',$payment)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <input type="number" placeholder="Cantidad" name="pay" id="pay" class="form-control @error('pay') is-invalid @enderror">
                                    @error('pay')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success">{{__('Pay')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection