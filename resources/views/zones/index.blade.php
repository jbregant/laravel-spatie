@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administracion de Zonas</h2>
            </div>
            <div class="pull-right">
                @can('zone.create')
                    <a class="btn btn-success" href="{{ route('zones.create') }}">Crear una nueva zona</a>
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


    <table id="zones-table" class="hover compact">
        <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th width="280px">Acciones</th>
        </tr>
        </thead>
        @foreach ($zones as $key => $zone)
            <tr>
                <td>{{ $zone->id }}</td>
                <td>{{ $zone->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('zones.show',$zone->id) }}">Ver</a>
                    @can('zone.edit')
                        <a class="btn btn-primary" href="{{ route('zones.edit',$zone->id) }}">Editar</a>
                    @endcan
                    @can('zone.delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['zones.destroy', $zone->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    <script>
        $(document).ready( function () {
            $('#zones-table').DataTable();
        } );
    </script>


@endsection