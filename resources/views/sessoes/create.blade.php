@extends('adminlte::page')

@section('contentheader_title')
Cadastro de Sessão
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Nova Sessão</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>'sessoes.store']) !!}

        <div class="form-group">
            {!! Form::label('atracao_id', 'Atração:') !!}
            {!! Form::select('atracao_id', 
                             \App\Atracoes::orderBy('nome')->pluck('nome', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('local', 'Local:') !!}
            {!! Form::text('local', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('data', 'Data:') !!}
            {!! Form::date('data', null, ['class'=>'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('hora', 'Hora:') !!}
            {!! Form::text('hora', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Criar Sessão', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

