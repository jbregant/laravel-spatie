@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Cliente</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-primary" href="{{ route('clients.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    <br>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Hubo algunos problemas con la edicion.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($client, ['method' => 'PATCH','route' => ['collectors.update', $client->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Nombre...','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Apellido:</strong>
                {!! Form::text('lastname', null, array('placeholder' => 'Apellido...','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Telefono:</strong>
                {!! Form::text('phone', null, array('placeholder' => 'Telefono...','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Direccion:</strong>
                {!! Form::text('address', null, array('placeholder' => 'Direccion...','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Localidad:</strong>
                {!! Form::select('city_id', $cities, $cityId, array('class' => 'form-control', 'placeholder' => 'Seleccione una localidad...')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-outline-primary">Enviar</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection