@extends('adminlte::page')

@section('contentheader_title')
Relatórios
@endsection

@section('content')
    <div class="container-fluid ">
        <h1>Relatórios</h1>

        <a href="{{ route('report.sessoes') }}" class="btn-sm btn-success">Sessoes</a>
        <a href="{{ route('report.reservas_mensal') }}" class="btn-sm btn-success">Reservas mensal</a>
    </div>
@endsection

