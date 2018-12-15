<div id="loan-detail" class="row">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nro Cliente:</strong>
                    {{ $loanGranted->client->id }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nro Credito:</strong>
                    {{ $loanGranted->id }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    {{ $loanGranted->client->name }} {{ $loanGranted->client->lastname }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipo de Credito:</strong>
                    {{ $loanGranted->loanType->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Monto solicitado:</strong>
                    ${{ $loanGranted->amount }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cuotas:</strong>
                    {{ $loanGranted->payments }} x ${{ $loanGranted->payment_amount }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de Otorgamiento:</strong>
                    {{ Carbon\Carbon::parse($loanGranted->created_at)->format('d-m-Y') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Observaciones:</strong>
                    {{ $loanGranted->description }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <table id="paymentsSimulatorTable" class="table">
                <thead>
                <th>Nro Cuota</th>
                <th>Fecha de Vencimiento</th>
                </thead>
                <tfoot id="tableFooterTotalPaymentsAmount" hidden>
                <tr>
                    <th align="center">Total a Pagar<span class="totalStars"></span></th>
                    <td id="tableTotalPaymentsAmountTxt"></td>
                    <td></td>
                </tr>
                </tfoot>
                <tbody id="tbodyPayments">
                @foreach($loanGrantedPayments as $payment)
                    <tr>
                        <td>{{ $payment->payment_number }}</td>
                        <td>{{ Carbon\Carbon::parse($payment->due_date)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
