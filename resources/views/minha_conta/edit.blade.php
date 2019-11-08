@extends('adminlte::page')

@section('contentheader_title')
Edição de Perfil
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Editando Perfil</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>["profile.update"], 'method'=>'put', 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Nome:') !!}
            {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('cpf', 'CPF:') !!}
            {!! Form::text('cpf', $user->cpf, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('profile_image', 'Imagem de Perfil:') !!}
            {!! Form::file('profile_image') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Editar Perfil', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

