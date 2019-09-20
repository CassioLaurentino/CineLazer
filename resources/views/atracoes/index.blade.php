@extends('adminlte::page')

@section('contentheader_title')
Atrações
@endsection

@section('content')
    <div class="container-fluid ">
        <h1>Atrações</h1>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Descricao</th>
                    <th>Tipo</th>
                    <th>Faixa Etária</th>
                </tr>
            </thead>
            <tbody>
                @foreach($atracoes as $atr)
                    <tr>
                        <td>{{ $atr->id }}</td>
                        <td>{{ $atr->nome }}</td>
                        <td>{{ $atr->descricao }}</td>
                        <td>{{ $atr->tipo->nome }}</td>
                        <td>{{ $atr->faixa_etaria }}</td>

                        <td>
                            <a href="{{ route('atracoes.edit', ['id'=>$atr->id]) }}" class="btn-sm btn-success">Editar</a>
                            <a href="{{ route('atracoes.destroy', ['id'=>$atr->id]) }}" class="btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('atracoes.create') }}" class="btn-sm btn-info">Novo</a>
    </div>
@endsection