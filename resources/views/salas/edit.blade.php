@extends('adminlte::page')

@section('contentheader_title')
Edição de Tipo
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Editando Tipo: {{$tipo->nome}}</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>["tipos.update", $tipo->id], 'method'=>'put']) !!}
        
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', $tipo->nome, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('descricao', 'Descrição:') !!}
            {!! Form::textarea('descricao', $tipo->descricao, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Editar Tipo', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

