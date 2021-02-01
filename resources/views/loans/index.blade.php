@extends('layouts.nav')

@section('content')
<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Prestamos</h3>
                    </div>
                    <div>
                        <a href="{{route('loans.create')}}" class="btn btn-primary">
                            {{__('New Loan')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-hover"> 
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('amount')}}</th>
                            <th scope="col">{{__('payments_number')}}</th>
                            <th scope="col">{{__('fee')}}</th>
                            <th scope="col">{{__('ministry_date')}}</th>
                            <th scope="col">{{__('due_date')}}</th>
                            <th scope="col">{{__('finished')}}</th>
                            <th scope="col">{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($loans as $loan)
                        <tr>
                            <td scope="row">{{$loan->id}}</td>
                            <td>{{$loan->name}}</td>
                            <td>{{$loan->amount}}</td>
                            <td>{{$loan->payments_number}}</td>
                            <td>{{$loan->fee}}</td>
                            <td>{{$loan->ministry_date}}</td>
                            <td>{{$loan->due_date}}</td>
                            <td>
                            @if($loan->finished)
                                <a href="{{route('payments.create',$loan->id)}}" class="btn btn-success">Finalizado</a>
                            @else
                                <a href="{{route('payments.create',$loan->id)}}" type="button" class="btn btn-danger">Abonar</button>
                            @endif
                            </td>
                            
                            <td>
                                <a href="{{route('loans.edit',$loan->id)}}" class="btn btn-outline-info btn-sm">
                                    {{__('Edit')}}
                                </a>  
                                <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{$loan->id}}">{{__('Delete')}}</button>
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
                axios.delete('{{route('loans.index')}}/' + id)
                    .then(result => {
                        Swal.fire({
                            title:'Eliminado!',
                            text:'El cliente ha sido eliminado.',
                            icon:'success',
                    })
                    .then(() => {
                        window.location.href='{{route('loans.index')}}';
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