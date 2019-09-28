@extends('adminlte::page')

@section('contentheader_title')
Reservas
@endsection

@push('styles')
    <link href="{{ asset('css/sala.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script>
        var sessions = {!! \App\Sessoes::where('atracao_id', $sessoes->atracao->id)->get() !!};
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/sala.js') }}"></script>
@endpush

@stack('styles')
@stack('scripts')

@section('content')

    <div class="container-fluid">
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
                             \App\Sessoes::where('atracao_id', $sessoes->atracao->id)->pluck('local', 'id')->toArray(),null,
                             ['class'=>'form-control']) !!}
        </div>

        {!! Form::label('poltrona', 'Selecione uma poltrona:') !!}
        <div class="sala">
            <p class="tela">TELA / PALCO</p>

            <!-- Poltronas -->
            <div class="grid-container"></div>
        </div>

        <input type="hidden" name="poltronas" id='poltronas'>

        <div class="form-group">
            {!! Form::submit('Criar Reserva', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection