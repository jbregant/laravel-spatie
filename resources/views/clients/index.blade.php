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

    <table id="clients-table" class="hover compact">
        <thead class="thead-light" style="border-bottom: 1px solid;">
        <tr>
            <th>No</th>
            <th scope="col">Nombre</th>
            <th>Dni</th>
            <th>Direccion</th>
            <th>Localidad</th>
            <th>Teléfono</th>
            <th>Fecha de Creacion</th>
            <th width="280px">Acciones</th>
        </tr>
        </thead>
        @foreach ($clients as $key => $client)
            <tr>
                <th scope="row">{{ $client->id }}</th>
                <td>{{ $client->name }} {{ $client->lastname }}</td>
                <td>{{ $client->dni }}</td>
                <td>{{ $client->address }}</td>
                <td>{{ $client->city->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->created_at }}</td>
                <td>
                    <a class="btn btn-outline-info" href="{{ route('clients.show',$client->id) }}">Ver</a>
                    @can('client.edit')
                        <a class="btn btn-outline-primary" href="{{ route('clients.edit',$client->id) }}">Editar</a>
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
    <div style="width: 50%; margin: 0 auto;">{{ $clients->links() }}</div>
    <script>
        // $(document).ready( function () {
        //     $('#clients-table').DataTable();
        // } );
    </script>

@endsection