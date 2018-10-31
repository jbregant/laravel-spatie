@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crear un nuevo Prestamo</h2>
            </div>
            <div class="pull-right">
                @can('loan.create')
                    <a class="btn btn-success" href="{{ route('loans.create') }}">Crear un nuevo credito</a>
                @endcan
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
        <table id="loans-table" class="hover compact">
            <thead class="thead-light">
            <tr>
                <th>No Credito</th>
                <th>No Cliente</th>
                <th>Nombre</th>
                <th>Tipo de Credito</th>
                <th>Cant Cuotas</th>
                <th>Interes</th>
                <th width="280px">Acciones</th>
            </tr>
            </thead>
            @foreach ($loansGranted as $key => $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->name }}</td>
                    <td>{{ $loan->zone->name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('collectors.show',$loan->id) }}">Ver</a>
                        @can('collector.edit')
                            <a class="btn btn-primary" href="{{ route('collectors.edit',$loan->id) }}">Editar</a>
                        @endcan
                        @can('collector.delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['collectors.destroy', $loan->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection