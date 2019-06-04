@extends('adminlte::page')

@section('contentheader_title')
Reservas
@endsection

@section('content')
    <div class="container-fluid ">
        <h1>Reservas</h1>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sessão</th>
                    <th>Poltrona</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $res)
                    <tr>
                        <td>{{ $res->sessao->atracao . ", " . $res->sessao->data . ":" . $res->sessao->hora ." " . $res->sessao->local }}</td>
                        <td>{{ $res->poltrona }}</td>

                        <td>
                            <a href="{{ route('reservas.edit', ['id'=>$res->id]) }}" class="btn-sm btn-success">Editar</a>
                            <a href="{{ route('reservas.destroy', ['id'=>$res->id]) }}" class="btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('reservas.create') }}" class="btn-sm btn-info">Novo</a>
    </div>
@endsection