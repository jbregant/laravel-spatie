@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crear un nuevo Credito</h2>
            </div>
            <div class="pull-right">
                @can('loan.create')
                    <a class="btn btn-success" href="{{ route('loans.create') }}">Crear un nuevo credito</a>
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
                <th>Valor Cuota</th>
                <th>Interes</th>
                <th>Monto Financiado</th>
                <th>Deuda Actualizada</th>
                <th>Fecha de Otorgamiento</th>
                <th width="280px">Acciones</th>
            </tr>
            </thead>
            @foreach ($loansGranted as $key => $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->client_id }}</td>
                    <td>{{ $loan->client->name }} {{ $loan->client->lastname }}</td>
                    <td>{{ $loan->loanType->name }}</td>
                    <td>{{ $loan->payments }}</td>
                    <td>{{ $loan->payment_amount }}</td>
                    <td>{{ $loan->loan_fee }}</td>
                    <td>{{ $loan->total_amount }}</td>
                    <td>{{ $loan->updated_amount }}</td>
                    <td>{{ Carbon\Carbon::parse($loan->created_at)->format('d-m-Y') }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('loans.show',$loan->id) }}">Ver</a>
                        {{--@can('collector.edit')--}}
                            {{--<a class="btn btn-primary" href="{{ route('loans.edit',$loan->id) }}">Editar</a>--}}
                        {{--@endcan--}}
                        @can('loan.delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['loans.destroy', $loan->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <script>
        $(document).ready( function () {
            $('#loans-table').DataTable();
        } );
    </script>

@endsection