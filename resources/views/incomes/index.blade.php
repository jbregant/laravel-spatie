@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ingreso de Pagos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('loans.index') }}"> Volver</a>
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
        <div class="col-lg-8">
            <div class="row">
                {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                {{--<div class="form-group">--}}
                {{--<strong>Cliente:</strong>--}}
                {{--{!! Form::select('client_id', $clients,[], array('id' => 'clientCombo', 'class' => 'form-control combobox', 'placeholder' => 'Seleccione un Cliente...')) !!}--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                {{--<div class="form-group">--}}
                {{--<strong>Tipo de Credito:</strong>--}}
                {{--{!! Form::select('loan_type_id', $loansType,[], array('id' => 'loanTypeCombo', 'class' => 'form-control combobox', 'placeholder' => 'Seleccione un Tipo de Prestamo...')) !!}--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Codigo de Cliente:</strong>
                        <input type="text" class="form-control" id="clientIdTxt" >
                        {{--{!! Form::text('loan_fee', null, array('id' => 'loanFee', 'placeholder' => '%','class' => 'form-control')) !!}--}}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>DNI:</strong>
                        <input type="text" class="form-control" id="dniTxt" >
                        {{--{!! Form::text('loan_fee', null, array('id' => 'loanFee', 'placeholder' => '%','class' => 'form-control')) !!}--}}
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-top:65%;"  id="searchClientBtn">Buscar</button>
                    </div>
                </div>
                {{--<div class="col-xs-6 col-sm-6 col-md-6">--}}
                {{--<div class="form-group">--}}
                {{--<strong>Monto a Financiar:</strong>--}}
                {{--{!! Form::number('amount', null, array('id' => 'amount', 'placeholder' => '$','class' => 'form-control')) !!}--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
                {{--<div class="form-group">--}}
                {{--<strong>Valor Cuota:</strong>--}}
                {{--{!! Form::number('payment_amount', null, array('id' => 'paymentAmount', 'readonly' => 'readonly','class' => 'form-control')) !!}--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="paymentsSimulatorTable" class="table">
                <thead>
                <th>Nro Credito</th>
                <th>Tipo Credito</th>
                <th>Nro Cuota</th>
                <th>Cantidad Cuotas</th>
                <th>Fecha de Vencimiento</th>
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
                </tbody>
            </table>
        </div>
    </div>
    <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}" rel="stylesheet">
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/custom/income.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jQuery-3.3.1/jquery.validate.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
@endsection