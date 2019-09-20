@extends('adminlte::page')

@section('contentheader_title')
Reservas
@endsection

@push('styles')
    <link href="{{ asset('css/sala.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/sala.js') }}"></script>
@endpush

@stack('styles')
@stack('scripts')

@section('content')
    {{ $reservas->sessao }}
    <div class="grid-container">

    </div>
    <!-- <div class="container-fluid">
        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        {!! Form::open(['route'=>'reservas.store']) !!}

        <div class="form-group">
            {!! Form::label('sessao_id', 'Sessão:') !!}
            {!! Form::select('sessao_id', 
                             \App\Sessoes::orderBy('local')->pluck('local', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('poltrona', 'Poltrona:') !!}
            {!! Form::number('poltrona', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Criar Reserva', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div> -->
@endsection