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
    public function index() {
        $reservas = Reservas::all();
        return view('reservas.index', ['reservas'=>$reservas]);
    }

    public function reserve() {
        return view('reservas.reserve');
    }

    public function create($id) {
        $atracao = Atracoes::find($id);
        $sessoes = Sessoes::search('sessoes')->where('atracao_id', $atracao->id)->get();
        print_r($sessoes); exit;
        return view('reservas.create', compact('sessoes'));
    }

    public function store(ReservasRequest $request) {
        $user = Auth::user();
        $novo_reserva = $request->all();

        $sessao = Sessoes::find($novo_reserva["sessao_id"]);
        $count = $sessao->poltronas_reservadas;
        $sessao->poltronas_reservadas = ++$count;
        
        $n_pol = $sessao->numero_de_poltronas;

        if ($n_pol[$novo_reserva["poltrona"]] != null) {
            return view('reservas.create');
        }

        $n_pol[$novo_reserva["poltrona"]] = $user->id;
        $sessao->numero_de_poltronas = $n_pol;

        $sessao->save();

        $novo_reserva["user_id"] = $user->id;
        $novo_reserva["sessao_id"] = $sessao->id;
        
        Reservas::create($novo_reserva);
        return redirect()->route('reservas');
    }

    public function destroy($id) {
        Reservas::find($id)->delete();
        return redirect()->route('reservas');
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
