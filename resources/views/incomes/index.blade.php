@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ingreso de Pagos</h2>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('method'=>'POST', 'id' => 'clientIdForm')) !!}
            <div class="row">

                <div class="col-xs-9 col-sm-9 col-md-9">
                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {!! Form::select('client_id', $clients,[], array('id' => 'clientCombo', 'class' => 'form-control', 'placeholder' => 'Seleccione un Cliente...')) !!}
                    </div>
                </div>
                {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
                {{--<div class="form-group">--}}
                {{--<strong>DNI:</strong>--}}
                {{--<input type="text" class="form-control" id="dniTxt" >--}}
                {{--{!! Form::text('loan_fee', null, array('id' => 'loanFee', 'placeholder' => '%','class' => 'form-control')) !!}--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-top:35%;"  id="searchClientBtn">Buscar</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-lg-8">
            {!! Form::open(array('method'=>'POST', 'id' => 'paymentForm')) !!}
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <div class="form-group">
                        <strong>Nro Credito:</strong>
                        {{--<input type="text" class="form-control" id="clientIdTxt" >--}}
                        {!! Form::text('loan_granted_id', null, array('id' => 'loanGrantedIdTxt', 'class' => 'form-control', 'disabled' => true)) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <strong>Tipo de Credito:</strong>
                    {{--<input type="text" class="form-control" id="clientIdTxt" >--}}
                    {!! Form::text('loan_type_id', null, array('id' => 'loanTypeIdTxt', 'class' => 'form-control', 'disabled' => true)) !!}
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Nro Cuotas:</strong>
                        {!! Form::text('payments', null, array('id' => 'paymentsTxt', 'class' => 'form-control', 'readonly' => true)) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Monto Cuota:</strong>
                        {!! Form::text('payment_amount', null, array('id' => 'paymentAmountTxt', 'class' => 'form-control', 'disabled' => true)) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Fecha de Otorgamiento:</strong>
                        {!! Form::text('loan_created_date', null, array('id' => 'loanDateTxt', 'class' => 'form-control', 'disabled' => true)) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Fecha de Pago:</strong>
                        {!! Form::text('payment_date', null, array('id' => 'payment-date-txt', 'class' => 'form-control datepicker', 'disabled' => true)) !!}
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2" id="paymentPartialDiv" style="display: none;">
                    <div class="form-group">
                        <strong>Pago Parcial:</strong>
                        {!! Form::text('partial_payment', null, array('id' => 'paymentPartialTxt', 'class' => 'form-control', 'disabled' => true)) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3" id="remainingDebtDiv" style="display: none;">
                    <div class="form-group">
                        <strong>Monto Restante:</strong>
                        {!! Form::text('ramining_debt', null, array('id' => 'remainingDebtTxt', 'class' => 'form-control', 'disabled' => true)) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Monto a Abonar:</strong>
                        {{--<input type="text" class="form-control" id="clientIdTxt" >--}}
                        {!! Form::text('payment_amount_paid', null, array('id' => 'paymentAmountPaidTxt', 'class' => 'form-control', 'disabled' => true)) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary" style="margin-top:14%;cursor:not-allowed;"  id="doPaymentBtn" disabled>Enviar</button>
                    </div>
                </div>
            </div>
            {!! Form::text('data', null, array('id' => 'paymentData', 'hidden' => true, 'data' => '')) !!}

            {!! Form::close() !!}
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12" id="div-table-payments" >
        </div>
    </div>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}" rel="stylesheet">
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/custom/income.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jQuery-3.3.1/jquery.validate.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
@endsection
