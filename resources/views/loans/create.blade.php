@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crear un nuevo credito</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-primary" href="{{ route('loans.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    <br>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Hubo algunos problemas con la creacion.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <br>

    <div class="row">
        <div class="col-lg-6">
            {!! Form::open(array('route' => 'loans.store','method'=>'POST', 'id' => 'loanForm')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {!! Form::select('client_id', $clients,[], array('id' => 'clientCombo', 'class' => 'form-control combobox', 'placeholder' => 'Seleccione un Cliente...')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Tipo de Credito:</strong>
                        {!! Form::select('loan_type_id', $loansType,[], array('id' => 'loanTypeCombo', 'class' => 'form-control combobox', 'placeholder' => 'Seleccione un Tipo de Prestamo...')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Interes:</strong>
                        {!! Form::text('loan_fee', null, array('id' => 'loanFee', 'placeholder' => '%','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Cuotas:</strong>
                        {!! Form::select('payments', [], [], array('id' => 'paymentsCombo', 'placeholder' => '0','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Monto a Financiar:</strong>
                        {!! Form::number('amount', null, array('id' => 'amount', 'placeholder' => '$','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5">
                    <div class="form-group">
                        <strong>Monto Total a Reintegrar:</strong>
                        {!! Form::number('total_amount', null, array('id' => 'totalAmount', 'readonly' => 'readonly','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Valor Cuota:</strong>
                        {!! Form::number('payment_amount', null, array('id' => 'paymentAmount', 'readonly' => 'readonly','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <button id="paymentsSimulatorBtn" type="submit" class="btn btn-outline-primary">Calcular Cuotas</button>
                        <input type="checkbox" class="offset-1" id="dateConfirmation" style="cursor: not-allowed;" disabled>Confirma Fechas de Vencimiento?</input>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Observaciones:</strong>
                        {!! Form::textarea('description', null, ['id' => 'descripcionText', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none; width:100%;']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                        <button id="addLoanBtn" type="submit" class="btn btn-outline-primary offset-8" style="cursor: not-allowed;" disabled>Crear Credito</button>
                </div>
            </div>
            {!! Form::close() !!}
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}" rel="stylesheet">
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/custom/loan.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jQuery-3.3.1/jquery.validate.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
@endsection