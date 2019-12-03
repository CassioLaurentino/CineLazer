@extends('adminlte::page')

@section('contentheader_title')
Relatórios
@endsection

@push('styles')
    <link href="{{ asset('css/relatorios.css') }}" rel="stylesheet">
@endpush

@stack('styles')

@section('content')
    <div class="container-fluid ">
        <h1>Relatórios</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="container-fluid ">
            <h3>Relatório de sessões</h3>
            {!! Form::open(['route'=>'report.sessoes']) !!}

                <div class="form-group col-sm-3 col-md-3 col-xs-3">
                    {!! Form::label('data_inicial', 'Data Inicial:') !!}
                    {!! Form::date('data_inicial', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group col-sm-3 col-md-3 col-xs-3">
                    {!! Form::label('data_final', 'Data Final:') !!}
                    {!! Form::date('data_final', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group col-sm-3 col-md-3 col-xs-3">
                    {!! Form::submit('Gerar Relatório', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>

        <div class="container-fluid">
            <h3>Relatório de reservas mensal</h3>
            {!! Form::open(['route'=>'report.reservas_mensal']) !!}

                <div class="form-group col-sm-3 col-md-3 col-xs-3">
                    {!! Form::label('data_inicial', 'Data Inicial:') !!}
                    {!! Form::date('data_inicial', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group col-sm-3 col-md-3 col-xs-3">
                    {!! Form::label('data_final', 'Data Final:') !!}
                    {!! Form::date('data_final', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group col-sm-3 col-md-3 col-xs-3">
                    {!! Form::submit('Gerar Relatório', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection

