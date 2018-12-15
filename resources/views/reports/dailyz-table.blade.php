
<table id="paymentsTable" class="table table-sm table-bordered">
    <thead>
    <th>Nro Cliente</th>
    <th>Nro Credito</th>
    <th>Monto</th>
    <th>Fecha</th>
    <th>Deuda Actual</th>
    </thead>
    <tfoot id="tableFooterTotalPaymentsAmount" >
    <tr>
        <td ></td>
        <th align="center">Total Recaudado:</th>
        <td id="tableTotalPaymentsAmountTxt" ><b>{{ $totalAmountPaid }}</b></td>
        <td></td>
        <td></td>
    </tr>
    </tfoot>
    <tbody id="tbodyPayments">
    @foreach($tableData as $key => $data)
        <tr>
            <th>{{ $data->client_id }}<span></span></th>
            <td>{{ $data->loan_id }}</td>
            <td>{{ $data->payment_amount_paid }}</td>
            <td>{{ Carbon\Carbon::parse($data->payment_date)->format('d-m-Y') }}</td>
            <td>{{ $data->debt }}</td>
        </tr>
    @endforeach
    </tbody>
</table>


