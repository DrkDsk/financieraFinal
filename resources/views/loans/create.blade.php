@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="mb-0">{{__('New Loan')}}</h3>
                    </div>
                    <div>
                        <a href="{{route('loans.index')}}" class="btn btn-danger">
                            {{__('Cancel')}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('loans.store')}}" method="POST">
                    @csrf
                    <div class="form-group form-row">
                        <div class="col-md-6">
                            <label for="inputClient_id">{{__('Name')}}</label>
                            <select name="client_id" id="client_id"class="form-control">
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="amount">{{__('amount')}}</label>
                            <input type="text" onchange="cuotaPay('número_de_pagos','cuota')" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror">
                            @error('cantidad')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="porcentaje">{{__('porcent')}}</label>
                            <input type="text" onchange="cuotaPay('número_de_pagos','cuota')" name="porcentaje" id="porcentaje" class="form-control @error('porcentaje') is-invalid @enderror">
                            @error('porcentaje')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="payments_number">{{__('payments_number')}}</label>
                            <input type="text" onchange="cuotaPay('número_de_pagos','cuota')" name="número_de_pagos" id="número_de_pagos" class="form-control @error('número_de_pagos') is-invalid @enderror">
                            @error('número_de_pagos')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fee">{{__('fee')}}</label>
                            <input type="text" onchange="cuotaPay('cuota','número_de_pagos')" name="cuota" id="cuota" class="form-control @error('cuota') is-invalid @enderror">
                            @error('cuota')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ministry_date">{{__('ministry_date')}}</label>
                            <input type="date" onchange="toDate('fecha_de_ministro','fecha_de_vencimiento')" name="fecha_de_ministro" id="fecha_de_ministro" class="form-control @error('fecha_de_ministro') is-invalid @enderror">
                            @error('fecha_de_ministro')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="due_date">{{__('due_date')}}</label>
                            <input type="date" onchange="toDays('fecha_de_vencimiento','fecha_de_ministro')" name="fecha_de_vencimiento" id="fecha_de_vencimiento" class="form-control @error('fecha_de_vencimiento') is-invalid @enderror">
                            @error('fecha_de_vencimiento')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg">{{__('Create')}}</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
function cuotaPay(id,id2){
    var cantidad = +document.getElementById('cantidad').value;
    if(cantidad){
        var porcentaje = ((+document.getElementById('porcentaje').value / 100)*cantidad)+cantidad;
    } 
    var dias = +document.getElementById(id).value;
    if(dias !== 0) document.getElementById(id2).value = porcentaje / dias;
    toDate('fecha_de_ministro','fecha_de_vencimiento');
}

function toDate(id,id2){
    var format = document.getElementById(id).value.split('-');
    var date = new Date(format[0],format[1]-1,format[2]);
    var dias = +document.getElementById('número_de_pagos').value;

    i=0
    date.setDate(date.getDate()+1)
    if(dias){
        while(i !== dias){
            if(date.getDay() == 0 || date.getDay() == 6) date.setDate(date.getDate()+1)
            else{
                date.setDate(date.getDate()+1)
                i++
            }
        }
    }
    
    date.setDate(date.getDate()-1)
    anio = date.getFullYear();
    mes  = '0' + (date.getMonth()+1);
    dia  = ("0" + date.getDate()).slice(-2);
    var fecha = anio + '-' + mes + '-' + dia;
    document.getElementById(id2).value = fecha;
}

function toDays(id,id2){
    var format = document.getElementById(id).value.split('-');
    var format2 = document.getElementById(id2).value.split('-');
    if(format2.length !== 1){
        var date  = new Date(format[0],format[1]-1,format[2]);
        var date2 = new Date(format2[0],format2[1]-1,format2[2]);
        var dif   = date - date2;
        var dias  = Math.floor(dif/(1000*60*60*24));
        if(dias){
            document.getElementById('número_de_pagos').value=dias;
            cuotaPay('número_de_pagos','cuota');
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
        e.preventDefault();
        }
    }))
});
</script>