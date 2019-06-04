@extends('adminlte::page')

@section('contentheader_title')
Cadastro de Tipo
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Novo Tipo</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>'tipos.store']) !!}
        
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('descricao', 'Descrição:') !!}
            {!! Form::textarea('descricao', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Criar Tipo', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

