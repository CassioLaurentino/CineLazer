@extends('adminlte::page')

@section('contentheader_title')
Edição de Reservas
@endsection

@section('content')
    <div class="container-fluid">
        <h1>Editando Reserva: {{ $reservas->sessao->atracao->nome . ", " . $reservas->sessao->data . ":" . $reservas->sessao->hora . ", " . $reservas->sessao->local }}</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>["reservas.update", $reservas->id], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label('sessao_id', 'Sessão:') !!}
            {!! Form::select('sessao_id', 
                             \App\Sessoes::orderBy('local')->pluck('local', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('poltrona', 'Poltrona:') !!}
            {!! Form::number('poltrona', $reservas->poltrona, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Editar Hábito', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

