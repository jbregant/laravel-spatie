@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administracion de Localidades</h2>
            </div>
            <div class="pull-right">
                @can('city.create')
                    <a class="btn btn-success" href="{{ route('cities.create') }}">Crear una nueva localidad</a>
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
            <th width="280px">Acciones</th>
        </tr>
        @foreach ($cities as $key => $city)
            <tr>
                <td>{{ $city->id }}</td>
                <td>{{ $city->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('cities.show',$city->id) }}">Ver</a>
                    @can('city.edit')
                        <a class="btn btn-primary" href="{{ route('cities.edit',$city->id) }}">Editar</a>
                    @endcan
                    @can('city.delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['cities.destroy', $city->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>


    {!! $cities->render() !!}


@endsection