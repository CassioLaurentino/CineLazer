@extends('adminlte::page')

@section('contentheader_title')
Relatórios
@endsection

@section('content')
    <div class="container-fluid ">
        <h1>Relatórios</h1>

        <a href="{{ route('report.poltronas') }}" class="btn-sm btn-success">Visualizar relatório</a>    
    </div>
@endsection

