@extends('adminlte::page')

@section('contentheader_title')
Atrações
@endsection

@section('table-delete')
"atracoes"
@endsection

@section('scripts')
    @include('layouts.partials.scripts')
@show

@section('content')
    <div class="container-fluid ">
        <h1>Atrações</h1>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descricao</th>
                    <th>Tipo</th>
                    <th>Faixa Etária</th>
                </tr>
            </thead>
            <tbody>
                @foreach($atracoes as $atr)
                    <tr>
                        <td>{{ $atr->nome }}</td>
                        <td>{{ $atr->descricao }}</td>
                        <td>{{ $atr->tipo->nome }}</td>
                        <td>{{ $atr->faixa_etaria }}</td>

                        @can('admin_only')
                            <td>
                                <a href="{{ route('atracoes.edit', ['id'=>$atr->id]) }}" class="btn-sm btn-success">Editar</a>
                                <a href="#" onClick="return ConfirmaExclusao({{$atr->id}})" class="btn-sm btn-danger">Remover</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
        @can('admin_only')
            <a href="{{ route('atracoes.create') }}" class="btn-sm btn-info">Novo</a>
        @endcan
    </div>
@endsection