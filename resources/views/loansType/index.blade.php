@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administracion de Tipos de Prestamos</h2>
            </div>
            <div class="pull-right">
                @can('loanstype.create')
                    <a class="btn btn-success" href="{{ route('loanstype.create') }}">Crear un nuevo tipo de prestamo</a>
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

    <table id="loansType-table" class="hover compact">
        <thead class="thead-light">
        <tr>
            <th scope="col">No</th>
            <th>Descripcion</th>
            <th>Minimo de Cuotas</th>
            <th>Maximo de Cuotas</th>
            <th>Interes</th>
            {{--<th>Frecuencia de Pago</th>--}}
            <th>Fecha de Creacion</th>
            <th width="280px">Acciones</th>
        </tr>
        </thead>
        @foreach ($loansType as $key => $loanType)
            <tr>
                <th scope="row">{{ $loanType->id }}</th>
                <td>{{ $loanType->name }}</td>
                <td>{{ $loanType->min_loan_payments }}</td>
                <td>{{ $loanType->max_loan_payments }}</td>
                <td>{{ $loanType->loan_fee }}</td>
                {{--<td>{{ $loanType->frecuency }}</td>--}}
                <td>{{ $loanType->created_at }}</td>
                <td>
                    {{--<a class="btn btn-outline-info" href="{{ route('loanstype.show',$loanType->id) }}">Ver</a>--}}
                    @can('loanstype.edit')
                        <a class="btn btn-outline-primary" href="{{ route('loanstype.edit',$loanType->id) }}">Editar</a>
                    @endcan
                    {{--@can('loanstype.delete')--}}
                        {{--{!! Form::open(['method' => 'DELETE','route' => ['loanstype.destroy', $loanType->id],'style'=>'display:inline']) !!}--}}
                        {{--{!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}--}}
                        {{--{!! Form::close() !!}--}}
                    {{--@endcan--}}
                </td>
            </tr>
        @endforeach
    </table>
    <script>
        $(document).ready( function () {
            $('#loansType-table').DataTable();
        } );
    </script>

@endsection