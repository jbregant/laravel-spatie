@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administracion de Roles</h2>
            </div>
            <div class="pull-right">
                @can('role.create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Crear Nuevo Rol</a>
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


    <table id="roles-table" class="hover compact">
        <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th width="280px">Acciones</th>
        </tr>
        </thead>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-outline-info" href="{{ route('roles.show',$role->id) }}">Ver</a>
                    @can('role.edit')
                        <a class="btn btn-outline-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                    @endcan
                    @can('role.delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    <script>
        $(document).ready( function () {
            $('#roles-table').DataTable();
        } );
    </script>

@endsection