@extends('adminlte::page')

@section('contentheader_title')
Cadastro de Atração
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Nova Atração</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>'atracoes.store']) !!}

        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('descricao', 'Descrição:') !!}
            {!! Form::textarea('descricao', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tipo_id', 'Tipo:') !!}
            {!! Form::select('tipo_id', 
                             \App\Tipos::orderBy('nome')->pluck('nome', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('faixa_etaria', 'Faixa Etária:') !!}
            {!! Form::number('faixa_etaria', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('cartaz', 'Cartaz:') !!}
            {!! Form::file('cartaz') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Criar Atração', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

