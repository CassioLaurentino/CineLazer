@extends('adminlte::page')

@section('contentheader_title')
Cadastro de Reserva
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Novo Reserva</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>'reservas.store']) !!}

        <div class="form-group">
            {!! Form::label('sessao_id', 'Hábito:') !!}
            {!! Form::select('sessao_id', 
                             \App\Sessao::orderBy('local')->pluck('local', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Criar Reserva', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

