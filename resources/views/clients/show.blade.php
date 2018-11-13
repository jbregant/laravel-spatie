@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Detalles del Cliente</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('clients.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $client->name }} {{ $client->lastname }}
            </div>
            <div class="form-group">
                <strong>Direccion:</strong>
                {{ $client->address }}
            </div>
            <div class="form-group">
                <strong>Localidad:</strong>
                {{ $client->city->name }}
            </div>
            <div class="form-group">
                <strong>Telefono:</strong>
                {{ $client->phone }}
            </div>
            <div class="form-group">
                <strong>Fecha de Creacion:</strong>
                {{ $client->created_at }}
            </div>
            <div class="form-group">
                <strong>Deuda Pendiente:</strong>
                {{--{{ $client->phone }}--}}
            </div>
            <div class="form-group">
                <strong>Detalle Creditos:</strong>
                {{--{{ $client->phone }}--}}
            </div>
        </div>
    </div>
@endsection
