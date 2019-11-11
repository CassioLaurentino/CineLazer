<?php

namespace App\Http\Controllers;

use App\Reservas;
use App\Atracoes;
use App\Sessoes;
use Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ReservasRequest;

class ReservasController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $reservas = Reservas::all();
        return view('reservas.index', ['reservas'=>$reservas]);
    }

    public function reserve() {
        return view('reservas.reserve');
    }

    public function create($id) {
        $sessoes = Sessoes::where('atracao_id', $id)->get()->first();

        if ($sessoes == null) {
            print_r("retornar saporra caralha"); exit;
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

        $novo_reserva["poltronas"] = $poltronas;
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
            $n_pol = $sessao->numero_de_poltronas;

            foreach ($poltronas as $key => $value) { 
                if ($value == null) {
                    continue;
                }

                if ($n_pol[$key] == null) {
                    continue;
                }

                $n_pol[$key] = null;
            }

            $sessao->poltronas_reservadas = $sessao->poltronas_reservadas - count($poltronas);
            $sessao->numero_de_poltronas = $n_pol;
            $sessao->save();

            $reserva->delete();
            $ret = array('status'=>'ok', 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
        } catch (\PDOException $e) {
            $ret = array('status'=>'erro', 'msg'=>$e->getMessage());
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
}
