<?php

namespace App\Http\Controllers;

use App\Reservas;
use App\Sessoes;
use Auth;

use Illuminate\Http\Request;
use App\Http\Requests\ReservasRequest;
use App\Http\Controllers\SessoesController;

class ReservasController extends Controller
{
    public function index() {
        $reservas = Reservas::all();
        return view('reservas.index', ['reservas'=>$reservas]);
    }

    public function create() {
        return view('reservas.create');
    }

    public function store(ReservasRequest $request) {
        $novo_reserva = $request->all();

        $sessao = Sessoes::find($novo_reserva["sessao_id"]);
        $count = $sessao->poltronas_reservadas;
        $sessao->poltronas_reservadas = ++$count;
        $sessao->save();

        $user = Auth::user();
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
