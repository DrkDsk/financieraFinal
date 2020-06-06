@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3 mx-auto">
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
                            <p>Saldo Abonado: ${{$payment['saldo_abonado']}}</p>
                        </div>

                        <div>
                            <p>Saldo Pendiente: ${{$payment['pendiente']}}</p>
                        </div>

                        <div>
                            <p>Cuota: ${{$payment['fee']}}</p>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>

    
    
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
</div>
@endsection