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
            <thead class="thead-light" style="border-bottom: 1px solid;">
            <tr>
                <th>No Credito</th>
                <th>No Cliente</th>
                <th>Nombre</th>
                <th>Tipo de Credito</th>
                <th>Cant Cuotas</th>
                <th>Valor Cuota</th>
                <th>Interes</th>
                <th>Monto Solicitado</th>
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
                    <td>{{ $loan->amount }}</td>
                    <td>{{ $loan->total_amount }}</td>
                    <td>{{ $loan->updated_amount }}</td>
                    <td>{{ Carbon\Carbon::parse($loan->loan_created_date)->format('d-m-Y') }}</td>
                    <td>
                        <a class="btn btn-outline-info" href="{{ route('loans.show',$loan->id) }}">Ver</a>
                        {{--@can('collector.edit')--}}
                            {{--<a class="btn btn-outline-primary" href="{{ route('loans.edit',$loan->id) }}">Editar</a>--}}
                        {{--@endcan--}}
                        @can('loan.delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['loans.destroy', $loan->id],'style'=>'display:inline', 'id' => 'form-delete']) !!}
                            {!! Form::submit('Borrar', ['class' => 'btn btn-danger btn-table-delete']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>
        <div style="width: 50%; margin: 0 auto;">{{ $loansGranted->links() }}</div>
    </div>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/custom/loan.index.js') }}"></script>
    <script>
        // $(document).ready( function () {
        //     $('#loans-table').DataTable();
        // } );
    </script>

@endsection