@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">

        <div class="card-body">
            <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(Session::has('message'))
                <p>{{Session::get('message')}}</p>
                @endif
                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                @error('file')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                <div>
                <button class="btn btn-success">Importar</button>
                </div>
            </form>
        </div>
    
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">Clientes</h3>
                    </div>
                    <div>
                        <a href="{{route('clients.create')}}" class="btn btn-primary">
                            {{__('New Client')}}
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
                            <th scope="col">{{__('Phone')}}</th>
                            <th scope="col">{{__('Address')}}</th>
                            <th scope="col" style="width: 210px">{{__('Actions')}}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td scope="row">{{$client->id}}</td>
                            <td>{{$client->name}}</td>
                            <td>{{$client->phone}}</td>
                            <td>{{$client->address}}</td>
                            <td>
                                <a href="" class="btn btn-outline-secondary btn-sm">
                                    {{__('Show')}}
                                </a>
                                <a href="{{route('clients.edit',$client->id)}}" class="btn btn-outline-info btn-sm">
                                    {{__('Edit')}}
                                </a>
                                <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{$client->id}}">{{__('Delete')}}</button>
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
                axios.delete('{{route('clients.index')}}/' + id)
                    .then(result => {
                        Swal.fire({
                            title:'Eliminado!',
                            text:'El cliente ha sido eliminado.',
                            icon:'success',
                    })
                    .then(() => {
                        window.location.href='{{route('clients.index')}}';
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