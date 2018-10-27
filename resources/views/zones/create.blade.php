@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crear nueva zona</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('zones.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    <br>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Hubo algunos problemas con la creacion.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(array('route' => 'zones.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Nombre...','class' => 'form-control')) !!}
            </div>
        </div>
        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>Apellido:</strong>--}}
                {{--{!! Form::text('name', null, array('placeholder' => 'Apellido...','class' => 'form-control')) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>Telefono:</strong>--}}
                {{--{!! Form::text('name', null, array('placeholder' => 'Telefono...','class' => 'form-control')) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>Direccion:</strong>--}}
                {{--{!! Form::text('name', null, array('placeholder' => 'Direccion...','class' => 'form-control')) !!}--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
            {{--<div class="form-group">--}}
                {{--<strong>Zona:</strong>--}}
                {{--<br/>--}}
                {{--@foreach($zones as $value)--}}
                    {{--<label>{{ Form::checkbox('zones[]', $value->id, false, array('class' => 'name')) }}--}}
                        {{--{{ $value->name }}</label>--}}
                    {{--<br/>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection