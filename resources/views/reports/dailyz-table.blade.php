
<table id="paymentsTable" class="table table-sm">
    <thead>
    <th>Nro Cliente</th>
    <th>Nro Credito</th>
    <th>Nombre</th>
    <th>Direccion</th>
    <th>Nro Cta</th>
    <th>Monto Cuota</th>
    <th>Fecha de Vencimiento</th>
    <th>Monto Abonado</th>
    <th>Fecha de Pago</th>
    <th>Deuda Actual</th>
    <th>Estado</th>
    </thead>
    <tfoot id="tableFooterTotalPaymentsAmount" >
    <tr>
        <td colspan="6"></td>
        <th align="center">Total</th>
        <td id="tableTotalPaymentsAmountTxt" colspan="4"><b>{{ $totalAmountPaid }}</b></td>
        <td></td>
    </tr>
    </tfoot>
    <tbody id="tbodyPayments">
    @foreach($tableData as $key => $data)
        <tr>
            <th>{{ $data->client_id }}<span></span></th>
            <td>{{ $data->loan_id }}</td>
            <td>{{ $data->name }} {{ $data->lastname }}</td>
            <td>{{ $data->address }}</td>
            <td>{{ $data->payment_number }}/{{ $data->payments }}</td>
            <td>{{ $data->payment_amount }}</td>
            <td>{{ Carbon\Carbon::parse($data->due_date)->format('d-m-Y') }}</td>
            <td>{{ $data->payment_amount_paid }}</td>
            <td>{{ Carbon\Carbon::parse($data->payment_date)->format('d-m-Y') }}</td>
            <td>{{ $data->debt }}</td>
            <td>{{ $data->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>


