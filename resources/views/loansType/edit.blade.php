@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Tipo de Credito</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('loanstype.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    <br>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Hubo algunos problemas con la edicion.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($loanType, ['method' => 'PATCH','route' => ['loanstype.update', $loanType->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Descripcion:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Descripcion...','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Minimo de Cuotas:</strong>
                {!! Form::text('min_loan_payments', null, array('placeholder' => 'Minimo de Cuotas...','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Maximo de Cuotas:</strong>
                {!! Form::text('max_loan_payments', null, array('placeholder' => 'Maximo de Cuotas...','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Interes:</strong>
                {!! Form::text('loan_fee', null, array('placeholder' => 'Interes...','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection