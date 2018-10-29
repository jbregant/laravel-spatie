@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crear un nuevo Prestamo</h2>
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

    <br>
    <div class="row">
        <div class="col-lg-6">
            {!! Form::open(array('route' => 'loans.store','method'=>'POST')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {!! Form::select('client_id', $clients,[], array('class' => 'form-control', 'placeholder' => 'Seleccione un Cliente...')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tipo de Credito:</strong>
                        {!! Form::select('loan_type_id', $loansType,[], array('id' => 'loanTypeCombo', 'class' => 'form-control', 'placeholder' => 'Seleccione un Tipo de Prestamo...')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Interes:</strong>
                        {!! Form::text('loan_fee', null, array('placeholder' => '%','class' => 'form-control')) !!}
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
                        <strong>Telefono:</strong>
                        {!! Form::text('phone', null, array('placeholder' => 'Telefono...','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-lg-6">
            {!! Form::open(array('route' => 'loans.store','method'=>'POST')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {!! Form::select('id', $clients,[], array('class' => 'form-control', 'placeholder' => 'Seleccione un Cliente...')) !!}
                    </div>
                </div>
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
                        <strong>Direccion:</strong>
                        {!! Form::text('address', null, array('placeholder' => 'Direccion...','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telefono:</strong>
                        {!! Form::text('phone', null, array('placeholder' => 'Telefono...','class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="row">--}}
    {{--<div class="col-lg-12 margin-tb">--}}
    {{--<div class="pull-left">--}}
    {{--<h2>Administracion de Clientes</h2>--}}
    {{--</div>--}}
    {{--<div class="pull-right">--}}
    {{--@can('zone.create')--}}
    {{--<a class="btn btn-success" href="{{ route('clients.create') }}">Crear un nuevo cliente</a>--}}
    {{--@endcan--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<br>--}}

    {{--@if ($message = Session::get('success'))--}}
    {{--<div class="alert alert-success">--}}
    {{--<p>{{ $message }}</p>--}}
    {{--</div>--}}
    {{--@endif--}}

    {{--<table id="clients-table" class="hover compact">--}}
    {{--<thead class="thead-light">--}}
    {{--<tr>--}}
    {{--<th>No</th>--}}
    {{--<th scope="col">Nombre</th>--}}
    {{--<th>Direccion</th>--}}
    {{--<th>Localidad</th>--}}
    {{--<th>Teléfono</th>--}}
    {{--<th>Fecha de Creacion</th>--}}
    {{--<th width="280px">Acciones</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--@foreach ($clients as $key => $client)--}}
    {{--<tr>--}}
    {{--<th scope="row">{{ $client->id }}</th>--}}
    {{--<td>{{ $client->name }} {{ $client->lastname }}</td>--}}
    {{--<td>{{ $client->address }}</td>--}}
    {{--<td>{{ $client->city->name }}</td>--}}
    {{--<td>{{ $client->phone }}</td>--}}
    {{--<td>{{ $client->created_at }}</td>--}}
    {{--<td>--}}
    {{--<a class="btn btn-info" href="{{ route('clients.show',$client->id) }}">Ver</a>--}}
    {{--@can('client.edit')--}}
    {{--<a class="btn btn-primary" href="{{ route('clients.edit',$client->id) }}">Editar</a>--}}
    {{--@endcan--}}
    {{--@can('client.delete')--}}
    {{--{!! Form::open(['method' => 'DELETE','route' => ['clients.destroy', $client->id],'style'=>'display:inline']) !!}--}}
    {{--{!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}--}}
    {{--{!! Form::close() !!}--}}
    {{--@endcan--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</table>--}}
    {{--<script>--}}
    {{--$(document).ready( function () {--}}
    {{--$('#clients-table').DataTable();--}}
    {{--} );--}}
    {{--</script>--}}

@endsection