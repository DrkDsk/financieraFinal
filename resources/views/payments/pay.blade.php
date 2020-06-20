@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-1">{{__('Details')}}</h3>
                </div>
            </div>

            <div class = "card-body">
                <div class="form-group form-row">
                    <div class="col-md-8">
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
            <div class="card-header">
            <h3 class="mb-4">Detalles</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">cuota</th>
                            <th scope="col">Abonado</th>
                            <th scope="col">Fecha de Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pago)
                        <tr>
                            <td scope="row">{{$pago->numero_pago}}</td>
                            <td scope="row">{{$pago->cuota}}</td>
                            <td scope="row">{{$pago->monto_recibido}}</td>
                            <td scope="row">{{$pago->fecha_pago}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($payment['pendiente'])
    <div class="col-md-3 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{__('New Payment')}}</h3>
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
                    <div class="form-group form-row">
                        <div class="col-md-4">
                            <label for="pay">{{__('amount')}}</label>
                            <input type="text" name="pay" id="pay" class="form-control @error('pay') is-invalid @enderror">
                            @error('pay')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">{{__('Pay')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection