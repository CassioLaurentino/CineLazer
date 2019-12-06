@extends('adminlte::page')

@section('contentheader_title')
Dashboard
@endsection

@push('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script>
        var reservas_canceladas = {!! $reservas_canceladas !!};
        var reservas_mensal = {!! $reservas_mensal !!};
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endpush

@stack('styles')
@stack('scripts')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6 col-md-3 col-xs-6">
      <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-red"><i class="fa fa-check"></i></span>
        <div id="reservas" class="info-box-content">
          <span class="info-box-text">Reservas esta semana</span>
          <span class="info-box-number">{!! $reservas_semanal !!}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <div class="col-sm-6 col-md-3 col-xs-6">
      <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-red"><i class="fa fa-plus"></i></span>
        <div id="poltronas" class="info-box-content">
          <span class="info-box-text">Poltronas livres</span>
          <span class="info-box-number">{!! $poltronas_livres !!}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <div class="col-sm-6 col-md-3 col-xs-6">
      <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-red"><i class="fa ion-person-add"></i></span>
        <div id="usuarios" class="info-box-content">
          <span class="info-box-text">Novos usuários este mês</span>
          <span class="info-box-number">{!! $usuarios_novos !!}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <div class="col-sm-6 col-md-3 col-xs-6">
      <div class="info-box">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
        <div id="atracao" class="info-box-content">
          <span class="info-box-text">Atração preferida</span>
          <span class="info-box-number">{!! $atracao_preferida !!}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-6 col-md-6 col-xs-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Bar Chart</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart" style="height:230px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xs-6">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Pizza Chart</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="pieChart" style="height:230px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</div>
@endsection

