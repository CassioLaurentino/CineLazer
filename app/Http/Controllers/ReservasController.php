<?php

namespace App\Http\Controllers;

use App\Reservas;
use App\Atracoes;
use App\Sessoes;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\ReservasRequest;
use Exception;

class ReservasController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $reservas = Reservas::where('user_id', Auth::user()->id)->get();
        return view('reservas.index', ['reservas'=>$reservas]);
    }

    public function create($id) {
        $sessoes = Sessoes::where('atracao_id', $id)->get()->first();
 
        if ($sessoes == null) {
            return view('home', ['atracoes'=>Atracoes::all()]);
        }

        return view('reservas.create')->with('sessoes', $sessoes);
    }

    public function store(ReservasRequest $request) {
        $user = Auth::user();
        $novo_reserva = $request->all();

        $poltronas = explode(',', $novo_reserva["poltronas"]);
        $sessao = Sessoes::find($novo_reserva["sessao_id"]);
        $n_pol = $sessao->numero_de_poltronas;

        foreach ($poltronas as $key => $value) { 
            if ($value == null || $value != $user->id) {
                continue;
            }

            if ($n_pol[$key] != null) {
                return view('reservas.create');
            }   

            $n_pol[$key] = $user->id;
        }
        
        $sessao->poltronas_reservadas = count(array_filter($n_pol));
        $sessao->numero_de_poltronas = $n_pol;
        $sessao->save();

        $novo_reserva["poltronas"] = array_keys(array_filter($poltronas));
        $novo_reserva["user_id"] = $user->id;
        $novo_reserva["sessao_id"] = $sessao->id;
        
        Reservas::create($novo_reserva);
        return redirect()->route('reservas');
    }

    public function destroy($id) {        
        try {
            $reserva = Reservas::find($id);
            $poltronas = array_filter($reserva->poltronas);
            $sessao = Sessoes::find($reserva->sessao_id);
            
            $this->calulateDateRange($sessao);
            
            $n_pol = $sessao->numero_de_poltronas;
            
            foreach ($poltronas as $key => $value) { 
                if ($value == null) {
                    continue;
                }

                $n_pol[$value] = null;
            }
            
            $sessao->poltronas_reservadas = $sessao->poltronas_reservadas - count($poltronas);
            if ($sessao->poltronas_reservadas < 0) {
                $sessao->poltronas_reservadas = 0;
            }
            $sessao->numero_de_poltronas = $n_pol;
            $sessao->save();

            DB::table('reservas_historico')->insert(
                ['reserva_id' => $reserva->id, 'created_at' => date('D M d Y H:i:s', time())]
            );

            $reserva->delete();
            $ret = array('status'=>'ok', 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        } catch (\Exception $e) {
            $ret = array('status'=>'erro_data', 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit($id) {
        $reservas = Reservas::find($id);
        return view('reservas.edit', compact('reservas'));
    }

    public function update(ReservasRequest $request, $id) {
        Reservas::find($id)->update($request->all());
        return redirect()->route('reservas');    
    }

    public function calulateDateRange(Sessoes $sessao) {
        $data = $sessao->data;
        $hora = $sessao->hora;

        date_default_timezone_set('America/Sao_Paulo');
        $current_date = date('d-m-Y H:i', time());

        $combined_date_and_time = $data . ' ' . $hora;
        $date_to_cancel = date('d-m-Y H:i', strtotime($combined_date_and_time . '-1 day'));

        if ($date_to_cancel <= $current_date) {
            throw new Exception('Desculpe, mas só é possível excluir uma reserva, com pelo menos 24 horas de antecedência!');
        }
    }
}
