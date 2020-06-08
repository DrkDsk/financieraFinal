@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Pagos</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-hover"> 
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('amount given')}}</th>
                            <th scope="col">{{__('fee')}}</th>
                            <th scope="col">{{__('payments_number')}}</th>
                            <th scope="col">{{__('received_payments')}}</th>
                            <th scope="col">{{__('paid_balance')}}</th>
                            <th scope="col">{{__('paid_pendient')}}</th>
                            <th scope="col">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($payments as $payment)
                        <tr>
                            <td scope="row">{{$payment->id}}</td>
                            <td>{{$payment->client->name}}</td>
                            <td>{{$payment->amount}}</td>
                            <td>{{$payment->fee}}</td>
                            <td>{{$payment->payments_number}}</td>
                            <td>{{$payment->monto_recibido}}</td>
                            <td>{{$payment->saldo_abonado}}</td>
                            <td>{{$payment->saldo_pendiente}}</td>
                            <!--consulta de pagos realizados al id loan_id con count-->
                            <!--consulta de suma del monto de los pagos recibidos hechos al id loan_id con count-->
                            <!--consulta de la resta del monto total menos el total de los pagos recibidos hechos al id loan_id con count-->
                            <td>
                            <a href="{{route('payments.create',$payment->id)}}" class="btn btn-primary">
                                {{__('Pay')}}
                            </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom-js')
<script>
    Swal.fire('Bienvenido','{{Auth::user()->name}}','success');

    $('body').on('click','.btn-delete',function(event){
        const id = $(this).data('id');
        Swal.fire({
            title: 'Estás seguro?',
            text: 'No podrás revertir esta acción',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo'
        })
        .then((result) => {
            if(result.value){
                axios.delete('{{route('payments.index')}}/' + id)
                    .then(result => {
                        Swal.fire({
                            title:'Eliminado!',
                            text:'El cliente ha sido eliminado.',
                            icon:'success',
                    })
                    .then(() => {
                        window.location.href='{{route('payments.index')}}';
                    });
                })
                    .catch(error => {
                        Swal.fire(
                            'Ocurrió un error!',
                            'El cliente no ha sido eliminado.',
                            'error');
                    });
                }
            });
        });
</script>
@endsection