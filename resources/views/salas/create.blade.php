@extends('adminlte::page')

@section('contentheader_title')
Cadastro de Sala
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/room.js') }}"></script>
@endpush

@stack('scripts')

@section('content')
    <div class="container-fluid">
        <h1>Nova Sala</h1>

        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>'salas.store']) !!}
        
        <div class="form-group">
            {!! Form::label('nome', 'Nome:') !!}
            {!! Form::text('nome', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('colunas', 'Colunas:') !!}
            {!! Form::number('colunas', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('fileiras', 'Fileiras:') !!}
            {!! Form::number('fileiras', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('numero_de_poltronas', 'Numero de poltronas:') !!}
            {!! Form::number('numero_de_poltronas', null, ['class'=>'form-control ', 'disabled']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::submit('Criar Sala', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

