<table id="paymentsTable" class="table table-sm table-bordered" style="width: 80%;">
    <thead>
    <th>#</th>
    <th>Cliente Nº</th>
    <th>Pago</th>
    <th>Cta</th>
    <th>Nombre</th>
    <th>Direccion</th>
    <th>Telefono</th>
    <th>Cred Nº</th>
    <th>Saldo</th>
    </thead>
    <tbody id="tbodyPayments">
    @foreach($tableData as $key => $data)
        <tr @if($data->mora)style="background-color: grey;" @endif>
            <th>{{ $key+1 }}</th>
            <th>{{ $data->client_id }}<span></span></th>
            <td></td>
            <td>{{ $data->payment_amount }}</td>
            <td>{{ $data->name }} {{ $data->lastname }}</td>
            <td>{{ $data->address }}</td>
            <td>{{ $data->phone }}</td>
            <td>{{ $data->loan_id }}</td>
            <td>{{ $data->debt }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{--<table id="paymentsTable" class="table table-sm">--}}
    {{--<thead>--}}
    {{--<th>Nro Cliente</th>--}}
    {{--<th>Nro Credito</th>--}}
    {{--<th>Nombre</th>--}}
    {{--<th>Direccion</th>--}}
    {{--<th>Nro Cta</th>--}}
    {{--<th>Fecha de Vencimiento</th>--}}
    {{--<th>Monto Cuota</th>--}}
    {{--<th>Pago Parcial</th>--}}
    {{--<th>Deuda Actual</th>--}}
    {{--<th>Estado</th>--}}
    {{--<th>Pago</th>--}}
    {{--</thead>--}}
    {{--<tfoot id="tableFooterTotalPaymentsAmount" hidden>--}}
    {{--<tr>--}}
        {{--<th align="center">Total a Pagar<span class="totalStars"></span></th>--}}
        {{--<td id="tableTotalPaymentsAmountTxt"></td>--}}
        {{--<td></td>--}}
    {{--</tr>--}}
    {{--</tfoot>--}}
    {{--<tbody id="tbodyPayments">--}}
    {{--@foreach($tableData as $key => $data)--}}
        {{--<tr>--}}
            {{--<th>{{ $data->client_id }}<span></span></th>--}}
            {{--<td>{{ $data->loan_id }}</td>--}}
            {{--<td>{{ $data->name }} {{ $data->lastname }}</td>--}}
            {{--<td>{{ $data->address }}</td>--}}
            {{--<td>{{ $data->payment_number }}/{{ $data->payments }}</td>--}}
            {{--<td>{{ Carbon\Carbon::parse($data->due_date)->format('d-m-Y') }}</td>--}}
            {{--<td>{{ $data->payment_amount }}</td>--}}
            {{--<td>{{ $data->payment_amount_paid }}</td>--}}
            {{--<td>{{ $data->debt }}</td>--}}
            {{--<td>{{ $data->status }}</td>--}}
            {{--<td></td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
{{--</table>--}}


