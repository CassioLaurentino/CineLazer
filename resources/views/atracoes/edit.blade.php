@extends('adminlte::page')

@section('contentheader_title')
Edição de Atração
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Editando Atração: {{$atracoes->nome}}</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>["atracoes.update", $atracoes->id], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', $atracoes->nome, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('descricao', 'Descrição:') !!}
            {!! Form::textarea('descricao', $atracoes->descricao, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tipo_id', 'Atração:') !!}
            {!! Form::select('tipo_id', 
                             \App\Tipos::orderBy('nome')->pluck('nome', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('faixa_etaria', 'Faixa Etária:') !!}
            {!! Form::number('faixa_etaria', $atracoes->faixa_etaria, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Editar Atração', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

