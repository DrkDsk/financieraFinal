@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Pagos</h3>
                    </div>
                    <div>
                        <a href="{{route('payments.create')}}" class="btn btn-primary">
                            {{__('Pay')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-hover"> 
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('amount')}}</th>
                            <th scope="col">{{__('fee')}}</th>
                            <th scope="col">{{__('payments_number')}}</th>
                            <th scope="col">{{__('received payments')}}</th>
                            <th scope="col">{{__('paid balance')}}</th>
                            <th scope="col">{{__('pendient paid')}}</th>
                            <th scope="col">{{__('finished')}}</th>
                            <th scope="col" style="width: 100px">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($payments as $payment)
                        <tr>
                            <td scope="row">{{$payments->id}}</td>
                            <td>{{__('Name')}}</td>
                            <td>{{$payments->amount}}</td>
                            <td>{{$payments->fee}}</td>
                            <td>{{$payments->payments_number}}</td>
                            <td>{{$payment->received payments}}</td>
                            <td>{{$payment->paid balance}}</td>
                            <td>{{$payment->pendient paid}}</td>
                            <td>
                                <a href="" class="btn btn-outline-info btn-sm">
                                    {{__('Edit')}}
                                </a>  

                                <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{$payment->id}}">{{__('Delete')}}</button>
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