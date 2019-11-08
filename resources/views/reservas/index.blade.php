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
                    <th>Poltronas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $res)
                    <tr>
                        <td>{{ $res->sessao->atracao->nome . ", " . $res->sessao->data . ":" . $res->sessao->hora . ", " . $res->sessao->local }}</td>
                        <td>{!! preg_replace('/(\"|\[|])/', "", json_encode(array_values(array_filter($res->poltronas)))) !!}</td>

                        <td>
                            <a href="{{ route('reservas.destroy', ['id'=>$res->id]) }}" class="btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('home') }}" class="btn-sm btn-info">Fazer uma nova reserva!</a>
    </div>
@endsection