@extends('adminlte::page')

@section('title', 'CineLazer')

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-md-12">
                <div class="page-header">
                    <h1 id="destaques">Destaques</h1>
                </div>

                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        @foreach($atracoes as $atr)
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <a href="{{ route('reservas.create', ['id'=>$atr->id]) }}"><img src="{{ asset('storage/' . $atr->cartaz) }}" alt="{{ $atr->nome }}"></a>
                                    
                                    <div class="caption text-center">
                                    <h3>{{ $atr->nome }}</h3>
                                    <p><a href="{{ route('reservas.create', ['id'=>$atr->id]) }}" class="btn btn-success" 
                                        role="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Reservar</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop