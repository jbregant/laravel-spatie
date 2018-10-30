@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crear un nuevo Prestamo</h2>
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
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <div class="form-group">
                        <strong>Interes:</strong>
                        {!! Form::text('loan_fee', null, array('id' => 'loanFee', 'placeholder' => '%','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Cuotas:</strong>
                        {!! Form::select('payments', [], [], array('id' => 'paymentsCombo', 'placeholder' => '0','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Monto:</strong>
                        {!! Form::number('total_amount', null, array('id' => 'totalAmount', 'placeholder' => '$','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <button id="simulatePayments" type="submit" class="btn btn-primary">Calcular Cuotas</button>
                    </div>
                </div>

                {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                {{--<div class="form-group">--}}
                {{--<strong>Direccion:</strong>--}}
                {{--{!! Form::text('address', null, array('placeholder' => 'Direccion...','class' => 'form-control')) !!}--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xs-12 col-sm-12 col-md-12">--}}
                {{--<div class="form-group">--}}
                {{--<strong>Telefono:</strong>--}}
                {{--{!! Form::text('phone', null, array('placeholder' => 'Telefono...','class' => 'form-control')) !!}--}}
                {{--</div>--}}
                {{--</div>--}}


                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-lg-6">
            <div class="row">
                <table class="table">
                    <thead>
                        <th>Nro Cuota</th>
                        <th>Monto</th>
                        <th>Fecha de Vencimiento</th>
                    </thead>
                    <tfoot id="tableFooterTotalPaymentsAmount" hidden>
                    <tr>
                        <th align="center">Total<span class="totalStars"></span></th>
                        <td id="tableTotalPaymentsAmountTxt" align="center"></td>
                        <td></td>
                    </tr>
                    </tfoot>
                    <tbody id="tbodyPayments">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}" rel="stylesheet">
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/loan.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jQuery-3.3.1/jquery.validate.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
@endsection