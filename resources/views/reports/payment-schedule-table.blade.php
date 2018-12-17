@if(!empty($loanGranted) && !empty($tableData))
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="form-group">
                <strong>Nro Cliente:</strong>
                <input id="clientIdTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->client->id }}">
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Nombre:</strong>
                <input id="nameTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->client->name }} {{ $loanGranted->client->lastname }}">
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Direccion:</strong>
                <input id="nameTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->client->address}}">
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Fecha:</strong>
                <input id="nameTxt" readonly="readonly" class="form-control" type="text" value="{{ date('d-m-Y') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="form-group">
                <strong>Nro Credito:</strong>
                <input id="clientIdTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->id }}">
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Cuotas:</strong>
                <input id="nameTxt" readonly="readonly" class="form-control" type="text" value="${{ $loanGranted->payment_amount }} x {{ $loanGranted->payments }}">
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Monto solicitado:</strong>
                <input id="nameTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->amount }}">
            </div>
        </div>
    </div>
    <table id="paymentsTable" class="table table-sm table-bordered">
        <thead>
        <th>Cuota Nº</th>
        <th>Vencimiento</th>
        <th>Cuota</th>
        <th>Pago $</th>
        <th>Fecha de Pago</th>
        </thead>
        <tbody id="tbodyPayments">
        @foreach($tableData as $data)
            <tr>
                <td>{{ $data['payment_number'] }}</td>
                <td>{{ Carbon\Carbon::parse($data['due_date'])->format('d-m-Y') }}</td>
                <td>{{ $data['payment_amount'] }}</td>
                <td>{{ ($data['payment_amount_paid']) ? $data['payment_amount_paid'] : '0' }}</td>
                @if($data['payment_date'])
                    <td>{{ Carbon\Carbon::parse($data['payment_date'])->format('d-m-Y') }}</td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
        @if(!empty($tableDataOrphans))
            @foreach($tableDataOrphans as $data)
                <tr>
                    <td>Extra</td>
                    <td></td>
                    <td></td>
                    <td>{{ $data['payment_amount_paid'] }}</td>
                    <td>{{ Carbon\Carbon::parse($data['payment_date'])->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
@else
    <table id="paymentsTable" class="table table-sm">
        <thead>
        <th>Nro Cliente</th>
        <th>Nro Credito</th>
        <th>Nro Cta</th>
        <th>Monto Cuota</th>
        <th>Fecha de Vencimiento</th>
        <th>Monto Abonado</th>
        <th>Fecha de Pago</th>
        <th>Deuda Actual</th>
        <th>Estado</th>
        </thead>
        <tbody id="tbodyPayments">
        </tbody>
    </table>
@endif

{{--@if(!empty($loanGranted) && !empty($tableData))--}}
{{--<div class="row">--}}
{{--<div class="col-xs-2 col-sm-2 col-md-2">--}}
{{--<div class="form-group">--}}
{{--<strong>Nro Cliente:</strong>--}}
{{--<input id="clientIdTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->client->id }}">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
{{--<div class="form-group">--}}
{{--<strong>Nombre:</strong>--}}
{{--<input id="nameTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->client->name }} {{ $loanGranted->client->lastname }}">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
{{--<div class="form-group">--}}
{{--<strong>Direccion:</strong>--}}
{{--<input id="nameTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->client->address}}">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
{{--<div class="form-group">--}}
{{--<strong>Fecha:</strong>--}}
{{--<input id="nameTxt" readonly="readonly" class="form-control" type="text" value="{{ date('d-m-Y') }}">--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="row">--}}
{{--<div class="col-xs-2 col-sm-2 col-md-2">--}}
{{--<div class="form-group">--}}
{{--<strong>Nro Credito:</strong>--}}
{{--<input id="clientIdTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->id }}">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
{{--<div class="form-group">--}}
{{--<strong>Cuotas:</strong>--}}
{{--<input id="nameTxt" readonly="readonly" class="form-control" type="text" value="${{ $loanGranted->payment_amount }} x {{ $loanGranted->payments }}">--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
{{--<div class="form-group">--}}
{{--<strong>Monto del Credito:</strong>--}}
{{--<input id="nameTxt" readonly="readonly" class="form-control" type="text" value="{{ $loanGranted->total_amount }}">--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<table id="paymentsTable" class="table table-sm">--}}
{{--<thead>--}}
{{--<th>Nro Cliente</th>--}}
{{--<th>Nro Credito</th>--}}
{{--<th>Nro Cta</th>--}}
{{--<th>Monto Cuota</th>--}}
{{--<th>Fecha de Vencimiento</th>--}}
{{--<th>Monto Abonado</th>--}}
{{--<th>Fecha de Pago</th>--}}
{{--<th>Deuda Actual</th>--}}
{{--<th>Estado</th>--}}
{{--</thead>--}}
{{--<tbody id="tbodyPayments">--}}
{{--@foreach($tableData as $key => $data)--}}
{{--<tr>--}}
{{--<th>{{ $data->client_id }}<span></span></th>--}}
{{--<td>{{ $data->loan_id }}</td>--}}
{{--<td>{{ $data->payment_number }}/{{ $data->payments }}</td>--}}
{{--<td>{{ $data->payment_amount }}</td>--}}
{{--<td>{{ Carbon\Carbon::parse($data->due_date)->format('d-m-Y') }}</td>--}}
{{--<td>{{ ($data->partial_payment_amount_paid) ? $data->partial_payment_amount_paid : $data->payment_amount_paid }}</td>--}}
{{--<td>{{ Carbon\Carbon::parse($data->payment_date)->format('d-m-Y') }}</td>--}}
{{--<td>{{ $data->debt }}</td>--}}
{{--<td>{{ $data->status }}</td>--}}
{{--</tr>--}}
{{--@endforeach--}}
{{--</tbody>--}}
{{--</table>--}}
{{--@else--}}
{{--<table id="paymentsTable" class="table table-sm">--}}
{{--<thead>--}}
{{--<th>Nro Cliente</th>--}}
{{--<th>Nro Credito</th>--}}
{{--<th>Nro Cta</th>--}}
{{--<th>Monto Cuota</th>--}}
{{--<th>Fecha de Vencimiento</th>--}}
{{--<th>Monto Abonado</th>--}}
{{--<th>Fecha de Pago</th>--}}
{{--<th>Deuda Actual</th>--}}
{{--<th>Estado</th>--}}
{{--</thead>--}}
{{--<tbody id="tbodyPayments">--}}
{{--</tbody>--}}
{{--</table>--}}
{{--@endif--}}

