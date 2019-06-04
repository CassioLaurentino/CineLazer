@extends('adminlte::page')

@section('contentheader_title')
Cadastro de Histórico
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Editando Histórico: {{$historicos->nome}}</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>["historicos.update", $historico->id], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label('habito_id', 'Hábito:') !!}
            {!! Form::select('habito_id', 
                             \App\Habito::orderBy('nome')->pluck('nome', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('hora', 'Hora:') !!}
            {!! Form::text('hora', $historico->hora, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('data', 'Data:') !!}
            {!! Form::date('data', $historico->data, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Editar Hábito', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

