@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administracion de Clientes</h2>
            </div>
            <div class="pull-right">
                @can('zone.create')
                    <a class="btn btn-success" href="{{ route('clients.create') }}">Crear un nuevo cliente</a>
                @endcan
            </div>
        </div>
    </div>

    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Localidad</th>
            <th>Telefono</th>
            <th>Fecha Creacion</th>
            <th width="280px">Acciones</th>
        </tr>
        @foreach ($clients as $key => $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }} {{ $client->lastname }}</td>
                <td>{{ $client->address }}</td>
                <td>{{ $client->city->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->created_at }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('clients.show',$client->id) }}">Ver</a>
                    @can('client.edit')
                        <a class="btn btn-primary" href="{{ route('clients.edit',$client->id) }}">Editar</a>
                    @endcan
                    @can('client.delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['clients.destroy', $client->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>


    {!! $clients->render() !!}


@endsection