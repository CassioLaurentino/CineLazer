<?php

namespace App\Http\Controllers;

use App\Sessoes;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\SessoesRequest;

class SessoesController extends Controller
{
    public function index() {
        $sessoes = Sessoes::all();
        return view('sessoes.index', ['sessoes'=>$sessoes]);
    }

    public function create() {
        return view('sessoes.create');
    }

    public function store(SessoesRequest $request) {
        $novo_sessao = $request->all();
        
        $novo_sessao["numero_de_poltronas"] = array_fill(0, $novo_sessao["numero_de_poltronas"]+1, "");

    	Sessoes::create($novo_sessao);

        return redirect()->route('sessoes');
    }

    public function destroy($id) {
        Sessoes::find($id)->delete();
        return redirect()->route('sessoes');
    }

    public function edit($id) {
        $sessoes = Sessoes::find($id);
        return view('sessoes.edit', compact('sessoes'));
    }

    public function update(SessoesRequest $request, $id) {
        Sessoes::find($id)->update($request->all());
        return redirect()->route('sessoes');    
    }

    public function find($id) {
        return Sessoes::find($id)->delete();
    }
}
