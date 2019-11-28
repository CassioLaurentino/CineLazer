@extends('adminlte::page')

@section('contentheader_title')
Salas
@endsection

@section('table-delete')
"salas"
@endsection

@section('scripts')
    @include('layouts.partials.scripts')
@show

@section('content')
    <div class="container-fluid ">
        <h1>Salas</h1>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Colunas</th>
                    <th>Fileiras</th>
                    <th>Numero de poltronas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salas as $sala)
                    <tr>
                        <td>{{ $sala->nome }}</td>
                        <td>{{ $sala->colunas }}</td>
                        <td>{{ $sala->fileiras }}</td>
                        <td>{{ $sala->numero_de_poltronas }}</td>

                        <td>
                            <a href="{{ route('salas.edit', ['id'=>$sala->id]) }}" class="btn-sm btn-success">Editar</a>
                            <a href="#" onClick="return ConfirmaExclusao({{$sala->id}})" class="btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('salas.create') }}" class="btn-sm btn-info">Novo</a>
    </div>
@endsection