<table id="paymentsTable" class="table">
    <thead>
    <th>Nro Credito</th>
    <th>Tipo Credito</th>
    <th>Nro Cuota</th>
    <th>Cantidad Cuotas</th>
    <th>Monto de la Cuota</th>
    <th>Pago Parcial</th>
    <th>Fecha de Vencimiento</th>
    <th>Monto del Credito</th>
    <th>Deuda Actual</th>
    <th>Estado</th>
    <th>Acciones</th>
    </thead>
    <tfoot id="tableFooterTotalPaymentsAmount" hidden>
    <tr>
        <th align="center">Total a Pagar<span class="totalStars"></span></th>
        <td id="tableTotalPaymentsAmountTxt"></td>
        <td></td>
    </tr>
    </tfoot>
    <tbody id="tbodyPayments">
    @foreach($loansGranted as $key => $loanGranted)
        @foreach($loanGranted['payments'] as $key => $payment)
            <tr data="{{ json_encode([
            'loan_id' => $loanGranted["loan"]->id,
            'loan_type' => $loanGranted["loan"]->loanType->name,
            'payment_id' => $payment->id,
            'payment_number' => $payment->payment_number,
            'payment_amount' => $payment->payment_amount,
            'payments' => $loanGranted["loan"]->payments,
            'due_date' => Carbon\Carbon::parse($payment->due_date)->format('d-m-Y'),
            'total_amount' => $loanGranted["loan"]->total_amount,
            'updated_amount' => $loanGranted["loan"]->updated_amount,
            'status' => $payment->status
            ]) }}">
                <th>{{ $loanGranted["loan"]->id }}<span></span></th>
                <td>{{ $loanGranted["loan"]->loanType->name }}</td>
                <td>{{ $payment->payment_number }}</td>
                <td>{{ $loanGranted["loan"]->payments }}</td>
                <td>{{ $payment->payment_amount }}</td>
{{--                <td>{{ $payment->payment_partial }}</td>--}}
                <td></td>
                <td>{{ Carbon\Carbon::parse($payment->due_date)->format('d-m-Y') }}</td>
                <td>{{ $loanGranted["loan"]->total_amount }}</td>
                <td>{{ $loanGranted["loan"]->updated_amount }}</td>
                <td>{{ $payment->status }}</td>
                {{--<td><button class="btn paymentActionBtn"><i class="fa fa-dollar" style="font-size:24px;color:green; cursor: pointer;"></i></button></td>--}}
                <td align="center">
                    @if ($loop->first)
                        <i class="fa fa-dollar paymentActionBtn" data-toggle="tooltip"  data-original-title="Realizar Pago" style="font-size:24px;color:green; cursor: pointer;"></i>
                    @else
                    @endif
                </td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>



