@extends('adminlte::page')

@section('contentheader_title')
Tipos
@endsection

@section('table-delete')
"tipos"
@endsection

@section('scripts')
    @include('layouts.partials.scripts')
@show

@section('content')
    <div class="container-fluid ">
        <h1>Tipos</h1>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipos as $tipo)
                    <tr>
                        <td>{{ $tipo->nome }}</td>
                        <td>{{ $tipo->descricao }}</td>

                        <td>
                            <a href="{{ route('tipos.edit', ['id'=>$tipo->id]) }}" class="btn-sm btn-success">Editar</a>
                            <a href="#" onClick="return ConfirmaExclusao({{$tipo->id}})" class="btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('tipos.create') }}" class="btn-sm btn-info">Novo</a>
    </div>
@endsection