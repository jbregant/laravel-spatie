@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administracion de Cobradores</h2>
            </div>
            <div class="pull-right">
                @can('zone.create')
                    <a class="btn btn-success" href="{{ route('collectors.create') }}">Crear un nuevo cobrador</a>
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
            <th>Zona</th>
            <th width="280px">Acciones</th>
        </tr>
        @foreach ($collectors as $key => $collector)
            <tr>
                <td>{{ $collector->id }}</td>
                <td>{{ $collector->name }}</td>
                <td>{{ $collector->zone->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('collectors.show',$collector->id) }}">Ver</a>
                    @can('collector.edit')
                        <a class="btn btn-primary" href="{{ route('collectors.edit',$collector->id) }}">Editar</a>
                    @endcan
                    @can('collector.delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['collectors.destroy', $collector->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>


    {!! $collectors->render() !!}


@endsection