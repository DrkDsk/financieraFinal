@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
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
                <form action="{{route('payments.store') }}" method="POST">
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
                            <input type="text" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror">
                            @error('amount')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="payments_number">{{__('payments_number')}}</label>
                            <input type="text" name="payments_number" id="payments_number" class="form-control @error('payments_number') is-invalid @enderror">
                            @error('payments_number')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fee">{{__('fee')}}</label>
                            <input type="text" name="fee" id="fee" class="form-control @error('fee') is-invalid @enderror">
                            @error('fee')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ministry_date">{{__('ministry_date')}}</label>
                            <input type="date" name="ministry_date" id="ministry_date" class="form-control @error('ministry_date') is-invalid @enderror">
                            @error('ministry_date')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="due_date">{{__('due_date')}}</label>
                            <input type="date" name="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror">
                            @error('due_date')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">{{__('Create')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection