@extends('adminlte::page')

@section('contentheader_title')
Sessões
@endsection

@section('table-delete')
"sessoes"
@endsection

@section('scripts')
    @include('layouts.partials.scripts')
@show


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
                @if ($status == "erro")
                    <script> HandleException('Desculpe, mas já existem reservas para esta sessão. Portanto não se pode altera-la!') </script>
                @endif
                @foreach($sessoes as $ses)
                    <tr>
                        <td>{{ $ses->atracao->nome }}</td>
                        <td>{{ $ses->local }}</td>
                        <td>{{ date('d-m-Y', strtotime($ses->data)) }}</td>
                        <td>{{ $ses->hora }}</td>
                        <td>{{ sizeof($ses->numero_de_poltronas)-1 }}</td>
                        <td>{{ $ses->poltronas_reservadas }}</td>
                        
                        @can('admin_only')
                            <td>
                                <a href="{{ route('sessoes.edit', ['id'=>$ses->id]) }}" class="btn-sm btn-success">Editar</a>
                                <a href="#" onClick="return ConfirmaExclusao({{$ses->id}})" class="btn-sm btn-danger">Remover</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>

        @can('admin_only')
            <a href="{{ route('sessoes.create') }}" class="btn-sm btn-info">Novo</a>
        @endcan
    </div>
@endsection