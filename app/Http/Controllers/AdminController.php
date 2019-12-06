<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Reservas;
use App\Atracoes;
use App\Sessoes;
use App\Tipos;
use App\Salas;
use Auth;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function dashboard() {
        // Reservas
        $reservas_semanal = DB::table('reservas')
                                ->selectRaw('count(*)')
                                ->whereRaw('created_at >=  to_date(?,?)',[date("Ymd", strtotime("-1 week")), 'YYYYMMDD'])
                                ->get()->first();

        // Poltronas
        $sessoes = DB::table('sessoes')
                                ->selectRaw('atracao_id, poltronas_reservadas, json_array_length(numero_de_poltronas) - 1 as numero_de_poltronas')
                                ->get();

        $poltronas_livres = 0;
        $maior_reserva = 0;
        $atracao_id = 0;
        foreach ($sessoes as $key => $value) {
            $poltronas_livres += $value->numero_de_poltronas - $value->poltronas_reservadas;
            if ($value->poltronas_reservadas > $maior_reserva) {
                $maior_reserva = $value->poltronas_reservadas;
                $atracao_id = $value->atracao_id;
            }
        }
        
        // Usuários
        $usuarios_novos = DB::table('users')
                                ->selectRaw('count(*)')
                                ->whereRaw('created_at >=  to_date(?,?)',[date("Ymd", strtotime("-1 month")), 'YYYYMMDD'])
                                ->get()->first();

        // Atração
        $atracao_preferida = DB::table('atracoes')
                                    ->selectRaw('nome')
                                    ->whereRaw('id = ?',[$atracao_id])
                                    ->get()->first();
        
        
        $reservas_canceladas = DB::table('reservas_historico')
                                    ->selectRaw("count(*), extract(MONTH from created_at) as mes")
                                    ->whereRaw('created_at >=  to_date(?,?)',[date("Ymd", strtotime("-7 month")), 'YYYYMMDD'])
                                    ->groupBy('mes')
                                    ->get();

        $reservas_mensal = DB::table('reservas')
                                ->selectRaw("count(*), extract(MONTH from created_at) as mes")
                                ->whereRaw('created_at >=  to_date(?,?)',[date("Ymd", strtotime("-7 month")), 'YYYYMMDD'])
                                ->groupBy('mes')
                                ->get();
        
        // print_r($reservas_canceladas); exit;

        return view('admin.dashboard', ['reservas_semanal'=>$reservas_semanal->count, 
        'poltronas_livres'=>$poltronas_livres, 'usuarios_novos'=>$usuarios_novos->count, 
        'atracao_preferida'=>$atracao_preferida->nome, 'reservas_canceladas'=>$reservas_canceladas,
        'reservas_mensal'=>$reservas_mensal]);
    }

    public function relatorios() {
        return view('admin.relatorios');
    }

}
