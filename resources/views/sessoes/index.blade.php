@extends('adminlte::page')

@section('contentheader_title')
Sessões
@endsection

@section('content')
    <div class="container-fluid ">
        <h1>Sessões</h1>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Atracao</th>
                    <th>Local</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Numero de poltronas</th>
                    <th>Numero de poltronas reservadas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessoes as $ses)
                    <tr>
                        <td>{{ $ses->atracao->nome }}</td>
                        <td>{{ $ses->local }}</td>
                        <td>{{ $ses->data }}</td>
                        <td>{{ $ses->hora }}</td>
                        <td>{{ $ses->numero_de_poltronas }}</td>
                        <td>{{ $ses->poltronas_reservadas }}</td>

                        <td>
                            <a href="{{ route('sessoes.edit', ['id'=>$ses->id]) }}" class="btn-sm btn-success">Editar</a>
                            <a href="{{ route('sessoes.destroy', ['id'=>$ses->id]) }}" class="btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('sessoes.create') }}" class="btn-sm btn-info">Novo</a>
    </div>
@endsection