@extends('adminlte::page')

@section('contentheader_title')
    Minha Conta
@endsection

@section('content')
    <div class="container-fluid ">
        <h1>Minha Conta</h1>

        <hr><h3><label>Nome:</label></h3>
        {{ $user->name }}
        
        <hr><h3><label>CPF:</label></h3>
        <p id="cpf">{{ $user->cpf }}</p>
        
        <hr><h3><label>Imagem de Perfil:</label></h3>

        @if($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}">
        @endif

        <hr><a href="{{ route('profile.edit') }}" class="btn-sm btn-success">Editar Perfil</a>
    </div>
@endsection