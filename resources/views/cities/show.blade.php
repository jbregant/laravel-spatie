@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Ver Localidad</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('cities.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $city->name }}
            </div>
        </div>
    </div>
@endsection