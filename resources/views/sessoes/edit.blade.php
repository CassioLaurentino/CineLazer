@extends('adminlte::page')

@section('contentheader_title')
Edição de Sessão
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Editando Sessão: {{$sessoes->display}}</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>["sessoes.update", $sessoes->id], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label('atracao_id', 'Atração:') !!}
            {!! Form::select('atracao_id', 
                             \App\Atracoes::orderBy('nome')->pluck('nome', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('local', 'Local:') !!}
            {!! Form::text('local', $sessoes->local, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('data', 'Data:') !!}
            {!! Form::date('data', $sessoes->data, ['class'=>'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('hora', 'Hora:') !!}
            {!! Form::text('hora', date('H:i', strtotime($sessoes->hora)), ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('sala_id', 'Sala:') !!}
            {!! Form::select('sala_id', 
                             \App\Salas::orderBy('nome')->pluck('nome', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Editar Sessão', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

