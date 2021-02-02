@extends('layouts.nav')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="form-group col-md-6">
                <div class="card">
                    <div class="card-header">
                        <p class="h2">Importar Clientes</p>
                    </div>
                    <div class="card-body">
                            <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    @if(Session::has('message'))
                                    <p>{{Session::get('message')}}</p>
                                    @endif
                                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-info">Importar Archivo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>

            <div class="col-md-6 form-group">
                <div class="card">
                    <div class="card-header">
                        <p class="h2">Nuevo Cliente</p>
                    </div>

                    <div class="card-body">
                        <form action="{{route('clients.store')}}" method="POST">
                        @csrf
                            <div class="row">
                                    <div class="form-group col-md-4">
                                        <input placeholder="Nombre Completo" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <input placeholder="Teléfono Móvil" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                    <input placeholder="Email" type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success">Crear</button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header bg-success">
                        <p class="h3">Tabla Clientes</p>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive-lg">
                            <table class="table table-striped table-dark">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Dirección</th>
                                        <th scope="col" style="width: 220px">Accciones</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{$client->name}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td>{{$client->address}}</td>
                                        <td>
                                            <a class="btn form-group btn-info btn-sm" href="{{route('clients.edit',$client->id)}}">
                                                {{__('Edit')}}
                                            </a>
                                            <button class="form-group btn btn-danger btn-sm btn-delete" data-id="{{$client->id}}">{{__('Delete')}}</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom-js')
<script>

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