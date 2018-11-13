@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $title }}</h2>
            </div>
            <div id="printBtnDiv" class="pull-right">
                <a id="printBtn" class="btn btn-success" href="#">Imprimir</a>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-4">
            {!! Form::open(array('method'=>'POST', 'id' => 'input-report-form')) !!}
            <div class="row">
                <div class="col-xs-9 col-sm-9 col-md-9">
                    <div class="form-group">
                        <strong>Fecha:</strong>
                        <input name="input_report" type="text" class="form-control datepickeR" placeholder="01-01-2018" id="input-report">
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-top:35%;"  id="search-btn">Buscar</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" id="report-table"></div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}" rel="stylesheet">
    {{--<script language="JavaScript" type="text/javascript" src="{{ asset('js/printThis.js') }}"></script>--}}
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/custom/reports.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
@endsection