@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administracion de Configuraciones</h2>
            </div>
            <div class="pull-right">
                @can('setting.create')
                    <a class="btn btn-success" href="{{ route('settings.create') }}">Crear una nueva configuracion</a>
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


    <table id="settings-table" class="hover compact">
        <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Valor</th>
            <th>Descripcion</th>
            <th width="280px">Acciones</th>
        </tr>
        </thead>
        @foreach ($settings as $key => $setting)
            <tr>
                <td>{{ $setting->id }}</td>
                <td>{{ $setting->name }}</td>
                <td>{{ $setting->value }}</td>
                <td>{{ $setting->description }}</td>
                <td>
                    <a class="btn btn-outline-info" href="{{ route('settings.show',$setting->id) }}">Ver</a>
                    @can('setting.edit')
                        <a class="btn btn-outline-primary" href="{{ route('settings.edit',$setting->id) }}">Editar</a>
                    @endcan
                    {{--@can('setting.delete')--}}
                        {{--{!! Form::open(['method' => 'DELETE','route' => ['settings.destroy', $setting->id],'style'=>'display:inline']) !!}--}}
                        {{--{!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}--}}
                        {{--{!! Form::close() !!}--}}
                    {{--@endcan--}}
                </td>
            </tr>
        @endforeach
    </table>
    <script>
        $(document).ready( function () {
            $('#settings-table').DataTable();
        } );
    </script>


@endsection